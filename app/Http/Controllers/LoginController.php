<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{

    public function index()
    {
        # code...
        return view('fumigator.pages.auth.index');
    }

    public function login (Request $request){
        if(Auth::attempt(['nama' => $request->nama, 'password' => $request->password])){
            return view('fumigator.pages.dashboard.index');
        }else{
            return redirect()->route('login');
        }
    }
    public function logout ()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
