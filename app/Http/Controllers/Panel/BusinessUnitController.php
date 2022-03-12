<?php

namespace App\Http\Controllers\Panel;

use App\Models\BusinessUnit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessUnitController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.business_unit.business_unit');
    }

    public function create()
    {
        return view('panel.business_unit.business_unit-create');
    }

    public function edit($businessUnitId)
    {
        // find record data
        $data = BusinessUnit::find($businessUnitId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        // example using markdown
        //Markdown::convertToHtml($data->content);

        return view('panel.business_unit.business_unit-edit')->with([
            'data' => $data
        ]);
    }

    // Functions

    public function getData(Request $request)
    {
        $model = BusinessUnit::query();

    	return $this->_datatable($model);
    }

    public function destroy($businessUnitId)
    {
        // find record data
        $data = BusinessUnit::find($businessUnitId);
        if(!$data) return response()->json([
            'code' => 400,
            'message' => 'Data not found.',
        ]);

        DB::beginTransaction();
        try {
            // get banner file name
            $bannerName = $data->banner;

            // do delete file
            $data->delete();

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
            'title' => 'required|string|max:191',
            'content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // create record
            BusinessUnit::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('business_unit')->with([
                'message' => 'Failed create data. Exception : ' . $th->getMessage(),
            ]);
        }

        return redirect()->route('business_unit')->with([
            'message' => 'Success to create data.',
        ]);
    }

    public function update(Request $request, $businessUnitId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'content' => 'required|string'
        ]);

        // find record data
        $data = BusinessUnit::find($businessUnitId);
        if(!$data) return redirect()->back()->withInput()->with([
            'error' => 'Data not found.'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            // do update data
            $data->title = $request->title;
            $data->content = $request->content;
            $data->slug = Str::slug($request->title);
            $data->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('business_unit')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        return redirect()->route('business_unit')->with([
            'message' => 'Success to update data.'
        ]);
    }

    // Others

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->editColumn('created_at', function(BusinessUnit $data) {
            return $data->created_at->format(config('constants.DATE.DEFAULT'));
        })
        ->make(true);
    }
}
