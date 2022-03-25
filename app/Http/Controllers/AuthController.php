<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\Models\Board;
class AuthController extends Controller
{
    public function login(){
        return view("login");
    }
    public function register(){
        return view("register");
    }
    public function doLogin(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return redirect()->back()->withErrors(["message"=>"Invalid Credentials"]);
        }
        if(Board::getListOne()){
            Session::put("board_id",Board::getListOne());
        }
        return redirect()->route('dashboard');
    }
    public function logout(){
        Auth::logout();
        Session::forget('board_id');
        return redirect()->route('login');
    }
}
