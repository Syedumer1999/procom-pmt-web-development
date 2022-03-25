<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function signUp(Request $request){
        $request->validate([
            'first_name'=>"required|regex:/(^([a-z A-Z]+)(\d+)?$)/u",
            'last_name' => 'required|regex:/(^([a-z A-Z]+)(\d+)?$)/u',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        //Create User
        $user=new User;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
   
        return response()->json(['user'=>$user]);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $user=User::where("id",Auth::user()->id)->first();

        $accessToken =auth()->user()->createToken('WebToken')->accessToken;

        return response()->json(['user' => auth()->user(), 'token' => $accessToken]);
    }
}
