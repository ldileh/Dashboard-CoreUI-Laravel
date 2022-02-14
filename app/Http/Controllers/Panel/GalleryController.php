<?php

namespace App\Http\Controllers\Panel;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon;

class GalleryController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.gallery.gallery');
    }

    // Functions

    public function getData()
    {
        $data = Gallery::all()->map(function ($item) {
            return [
                'id' => $item->id,
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

    public function store(Request $request)
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
                // create record
                Gallery::insert($listItem->toArray());

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

}
