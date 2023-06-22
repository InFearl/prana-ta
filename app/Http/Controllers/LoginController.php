<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        # code...
        return view('fumigator.pages.auth.index', [
            'title' => 'login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('users')->attempt(['nama' => $request->nama, 'password' => $request->password])) {
            // $request->session()->regenerate();
            // dd(Auth::guard('users')->user());
            return redirect()->intended('/');
            // return 'Iyaaaaah';   
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
