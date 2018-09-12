<?php

namespace App\Http\Controllers\Panel;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function edit($userId)
    {
        // find record data
        $data = User::find($userId);
        if(!$data) return redirect()->back()->with([
            'error' => 'Data not found.'
        ]);

        return view('panel.user-edit')->with([
            'data' => $data
        ]);
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
        // find record data
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

    public function update(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // find record data
        $data = User::find($userId);
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
        $data->email = $request->email;
        if($request->password){
            $data->password = Hash::make($request->password);
        }
        $data->save();

        return redirect()->route('user')->with([
            'message' => 'Success to update data.'
        ]);
    }

    ////////////
    // Others //
    ////////////
    
    private function _datatable($model)
    {
    	return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('user_role', function(User $query){
            return $query->userRole->name;
        })
        ->make(true);
    }
}
