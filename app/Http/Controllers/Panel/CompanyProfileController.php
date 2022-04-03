<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CompanyProfileType;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends Controller
{
    // Views

    public function index()
    {
        return view('panel.company_profile.index');
    }

    public function change($companyProfileTypeId)
    {
        $data = CompanyProfile::where('company_profile_type_id', $companyProfileTypeId)->first();
        $type = CompanyProfileType::find($companyProfileTypeId);

        if($type == null){
            abort(404, 'Company Profile Type not found!');
        }

        return view('panel.company_profile.company_profile-update')->with([
            'content' => $data != null ? $data->content : '',
            'type' => $type
        ]);
    }

    // Functions

    public function getData()
    {
        $model = CompanyProfileType::query();

    	return $this->_datatable($model);
    }

    public function update(Request $request, $companyProfileTypeId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        // find record data
        $data = CompanyProfile::where('company_profile_type_id', $companyProfileTypeId)->first();

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            if($data != null){
                $data->content = $request->content;
                $data->save();
            }else{
                CompanyProfile::create([
                    'company_profile_type_id' => $companyProfileTypeId,
                    'content' => $request->content
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('company_profile')->with([
                'message' => 'Failed to update data. Exception: ' . $th->getMessage()
            ]);
        }

        return redirect()->route('company_profile')->with([
            'message' => 'Success to update data.'
        ]);
    }

    // Others

    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('column_content_is_filled', function(CompanyProfileType $data) {
            return !empty($data->companyProfile->content) ? "True" : "False";
        })
        ->make(true);
    }
}
