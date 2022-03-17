<?php

namespace App\Http\Controllers\Panel;

use App\Models\PostImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DataTables;

class HomeController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.home');
    }

    public function profile()
    {
        return view('panel.profile')->with([
            'data' => Auth::user(),
        ]);
    }

    // Functions

    public function getDataPostImage()
    {
        $data = PostImage::query();

        return $this->_datatablePostImage($data);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // find record data
        $data = Auth::user();

        $validator->sometimes('email', 'required|string|email|max:255|unique:users', function($request) use ($data){
            return $request->email != $data->email;
        });

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // do update data
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->password){
            $data->password = Hash::make($request->password);
        }
        $data->save();

        return redirect()->back()->with([
            'message' => 'Success to update data.'
        ]);
    }

    public function storeImages(Request $request)
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
                    'created_at' => Carbon::now()
                ]);
            }
        }

        if($listItem->isNotEmpty()){
            DB::beginTransaction();
            try {
                // create records
                PostImage::insert($listItem->toArray());

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();

                foreach ($listItem->toArray() as $item) {
                    $this->deleteFile($item['image']);
                }

                return response()->json([
                    'code' => 500,
                    'message' => 'Failed store image. exception : ' . $th->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success store image',
        ]);
    }

    public function destroyImage($postImageId)
    {
        // find record data
        $data = PostImage::find($postImageId);
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
        $path = config('constants.STORAGE.PATH.OTHERS');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteFile($fileName)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathFile($fileName));
        }
    }

    private function _datatablePostImage($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(PostImage $data) {
            return $data->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->addColumn('url_image', function(PostImage $data){
            return $data->getImageUrl();
        })
        ->make(true);
    }
}
