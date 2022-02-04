<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.news.news');
    }

    public function create()
    {
        return view('panel.news.news');
    }

    public function edit($newsId)
    {
        return view('panel.news.news');
    }

    // Functions

    public function getData(Request $request)
    {
        $model = News::all();

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

        $data->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success to delete data.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // create record
        News::create([

        ]);

        return redirect()->route('news')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $newsId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // find record data
        $data = News::find($newsId);
        if(!$data) return redirect()->back()->withInput()->with([
            'error' => 'Data not found.'
        ]);

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
        $data->save();

        return redirect()->route('news')->with([
            'message' => 'Success to update data.'
        ]);
    }

    // Others

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->make(true);
    }
}
