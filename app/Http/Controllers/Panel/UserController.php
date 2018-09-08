<?php

namespace App\Http\Controllers\Panel;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    ///////////
    // Views //
    ///////////
    
    public function index()
    {
    	return view('panel.user');
    }

    public function create()
    {
        return view('panel.user-create');
    }

    ///////////////
    // Functions //
    ///////////////
    
    public function getData(Request $request)
    {
        $model = User::userExceptAdmin();

    	return $this->_datatable($model);
    }

    public function destroy($userId)
    {
        $data = User::find($userId);
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // create record
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role_id' => config('constants.USER.ROLE.USER'),
        ]);

        return redirect()->route('user')->with([
            'message' => 'Success to create data.',
        ]);
    }

    ////////////
    // Others //
    ////////////
    
    public function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('user_role', function(User $query){
            return $query->userRole->name;
        })
        ->make(true);
    }
}
