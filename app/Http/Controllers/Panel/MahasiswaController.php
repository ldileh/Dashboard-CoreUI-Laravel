<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class MahasiswaController extends Controller
{
    // Views
    
    public function index()
    {
    	return view('panel.mahasiswa.mahasiswa');
    }

    // Functions
    
    public function getData(Request $request)
    {
        $model = User::userMahasiswa();

    	return $this->_datatable($model);
    }

    // Others
    
    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->make(true);
    }
}
