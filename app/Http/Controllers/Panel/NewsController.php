<?php

namespace App\Http\Controllers\Panel;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Markdown;
use Carbon;

class NewsController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.news.news');
    }

    public function create()
    {
        return view('panel.news.news-create');
    }

    public function edit($newsId)
    {
        // find record data
        $data = News::find($newsId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        // example using markdown
        //Markdown::convertToHtml($data->content);

        return view('panel.news.news-edit')->with([
            'data' => $data
        ]);
    }

    // Functions

    public function getData(Request $request)
    {
        $model = News::query();

    	return $this->_datatable($model);
    }

    public function destroy($newsId)
    {
        // find record data
        $data = News::find($newsId);
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
                $this->deleteBanner($bannerName);
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
            'description' => 'required|string|max:191',
            'content' => 'required|string',
        ]);

        // save image on storage
        $bannerName = null;
        if($request->banner != null){
            $bannerName = time().'.'.$request->banner->extension();
            $request->banner->storeAs($this->getPathBanner(), $bannerName, $this->getDiskConfig());
        }

        DB::beginTransaction();
        try {
            // create record
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'banner' => $bannerName
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            $this->deleteBanner($bannerName);

            return redirect()->route('news')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('news')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $newsId)
    {
        $validator = Validator::make($request->all(), [
            'banner' => 'image|mimes:jpeg,png,jpg',
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'content' => 'required|string',
        ]);

        // find record data
        $data = News::find($newsId);
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
            $data->content = $request->content;
            $data->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('news')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        // do update file banner if transaction is success
        if($bannerNew != null || !empty($bannerNew)){
            // do store new file banner
            $request->banner->storeAs($this->getPathBanner(), $bannerNew, $this->getDiskConfig());

            // do delete previous file banner if exist
            $this->deleteBanner($bannerOld);
        }

        return redirect()->route('news')->with([
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

    private function getPathBanner($fileName = null)
    {
        $path = config('constants.STORAGE.PATH.NEWS');

        return $fileName != null ? $path . '/' . $fileName : $path;
    }

    private function deleteBanner($fileName)
    {
        if($fileName != null || !empty($fileName)){
            Storage::disk($this->getStorage())->delete($this->getPathBanner($fileName));
        }
    }

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(News $news) {
            return $news->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->make(true);
    }
}
