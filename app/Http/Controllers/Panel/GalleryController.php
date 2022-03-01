<?php

namespace App\Http\Controllers\Panel;

use App\Models\Gallery;
use App\Models\GalleryDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon;
use DataTables;

class GalleryController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.gallery.gallery');
    }

    public function create()
    {
        return view('panel.gallery.gallery-create');
    }

    public function gallery($galleryId)
    {
        $data = Gallery::find($galleryId);

        return view('panel.gallery.gallery-detail')->with([
            'gallery_id' => $galleryId,
            'data' => $data
        ]);
    }

    // Functions

    public function getData()
    {
        $data = Gallery::query();

        return $this->_datatable($data);
    }

    public function getDataDetail($galleryId)
    {
        $gallery = Gallery::find($galleryId);
        if($gallery == null){
            return response()->json([
                'code' => 500,
                'data' => [],
                'message' => 'Data gallery is not found!',
            ], 200);
        }

        $data = $gallery->images()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'gallery_id' => $item->gallery_id,
                'image' => $item->image,
                'size' => $item->size,
                'pathFile' => url('storage/'.$this->getPathFile()),
            ];
        });

        return response()->json([
            'code' => 200,
            'data' => $data,
            'message' => 'Success get data gallery',
        ], 200);
    }

    public function store(Request $request, $galleryId)
    {
        $request->validate([
            'file.*' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // save image on storage
        $listItem = collect();
        if($request->file != null){
            foreach ($request->file as $item) {
                $fileName = Carbon::now()->getPreciseTimestamp(3).'.'.$item->extension();
                $fileSize = $item->getSize();

                $item->storeAs($this->getPathFile(), $fileName, $this->getDiskConfig());

                $listItem->push([
                    'image' => $fileName,
                    'size' => $fileSize,
                ]);
            }
        }

        if($listItem->isNotEmpty()){
            DB::beginTransaction();
            try {
                // find gallery data
                $gallery = Gallery::find($galleryId);

                if($gallery == null){
                    throw new Exception('Data gallery not found!');
                    return;
                }

                $details = [];
                foreach ($listItem as $item) {
                    // push the new item
                    array_push($details, new GalleryDetail($item));
                }

                // create records
                $gallery->images()->saveMany($details);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();

                foreach ($listItem->toArray() as $item) {
                    $this->deleteFile($item['image']);
                }

                return response()->json([
                    'code' => 500,
                    'message' => 'Failed store image gallery. exception : ' . $th->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success store image gallery',
        ]);
    }

    public function storeNewGallery(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225'
        ]);

        DB::beginTransaction();
        $gallery = null;
        try {
            // create record
            $gallery = Gallery::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('gallery')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('gallery.detail', $gallery->id)->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function destroy($galleryId)
    {
        // find record data
        $data = Gallery::find($galleryId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get banner file name
            $fileNames = $data->images()->map(function($item) {
                return [
                    'image' => $item->image
                ];
            });

            // do delete file
            if($data->delete()){
                // if delete record is success, do delete files
                foreach ($fileNames as $fileName) {
                    $this->deleteFile($fileName);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'message' => 'Failed to delete data. Exception : ' . $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success delete image gallery',
        ]);
    }

    public function destroyImage($galleryId, $galleryDetailId)
    {
        // find record data
        $data = GalleryDetail::find($galleryDetailId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get banner file name
            $fileName = $data->image;

            // do delete file
            if($data->delete()){
                // if delete record is success, do delete file
                $this->deleteFile($fileName);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'message' => 'Failed to delete data. Exception : ' . $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success delete image gallery',
        ]);
    }

    // Others

    private function getStorage()
    {
        return config('constants.STORAGE.DISK.DEFAULT');
    }

    private function getDiskConfig()
    {
        return ['disk' => $this->getStorage()];
    }

    private function getPathFile($fileName = null)
    {
        $path = config('constants.STORAGE.PATH.GALLERY');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteFile($fileName)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathFile($fileName));
        }
    }

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(Gallery $data) {
            return $data->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->make(true);
    }
}
