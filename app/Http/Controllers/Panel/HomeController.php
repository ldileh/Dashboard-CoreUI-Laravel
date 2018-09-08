<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
}
