<?php

namespace App\Http\Controllers\Panel;

use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Markdown;

class VideoController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.video.video');
    }

    public function create()
    {
        return view('panel.video.video-create');
    }

    public function edit($videoId)
    {
        // find record data
        $data = Video::find($videoId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        // example using markdown
        //Markdown::convertToHtml($data->content);

        return view('panel.video.video-edit')->with([
            'data' => $data
        ]);
    }

    // Functions

    public function getData(Request $request)
    {
        $model = Video::query();

    	return $this->_datatable($model);
    }

    public function destroy($videoId)
    {
        // find record data
        $data = Video::find($videoId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get banner file name
            $bannerName = $data->banner;

            // do delete file
            if($data->delete()){
                // if delete record is success, do delete file
                $this->deleteImage($bannerName);
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
            'message' => 'Success to delete data.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner' => 'image|mimes:jpeg,png,jpg',
            'title' => 'required|string|max:191',
            'video_url' => 'required|string|max:225',
            'description' => 'required|string|max:191',
        ]);

        // save image on storage
        $bannerName = null;
        if($request->banner != null){
            $bannerName = time().'.'.$request->banner->extension();
            $request->banner->storeAs($this->getPathImage(), $bannerName, $this->getDiskConfig());
        }

        DB::beginTransaction();
        try {
            // create record
            Video::create([
                'title' => $request->title,
                'description' => $request->description,
                'banner' => $bannerName,
                'video_url' => $request->video_url,
                'slug' => Str::slug($request->title),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            $this->deleteImage($bannerName);

            return redirect()->route('video')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('video')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $videoId)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg',
            'title' => 'required|string|max:191',
            'video_url' => 'required|string|max:225',
            'description' => 'required|string|max:191'
        ]);

        // find record data
        $data = Video::find($videoId);
        if(!$data) return redirect()->back()->withInput()->with([
            'error' => 'Data not found.'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $bannerNew = null;
        $bannerOld = null;

        DB::beginTransaction();
        try {
            // store new file name banner
            if($request->banner != null){
                $bannerNew = time().'.'.$request->banner->extension();
            }

            // update file banner
            if($bannerNew != null){
                $bannerOld = $data->banner;

                // update banner file name with the new one
                $data->banner = $bannerNew;
            }

            // do update data
            $data->title = $request->title;
            $data->description = $request->description;
            $data->video_url = $request->video_url;
            $data->slug = Str::slug($request->title);
            $data->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('video')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        // do update file banner if transaction is success
        if($bannerNew != null || !empty($bannerNew)){
            // do store new file banner
            $request->banner->storeAs($this->getPathImage(), $bannerNew, $this->getDiskConfig());

            // do delete previous file banner if exist
            $this->deleteImage($bannerOld);
        }

        return redirect()->route('video')->with([
            'message' => 'Success to update data.'
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

    private function getPathImage($fileName = null)
    {
        $path = config('constants.STORAGE.PATH.VIDEO');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteImage($fileName)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathImage($fileName));
        }
    }

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(Video $data) {
            return $data->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->make(true);
    }
}
