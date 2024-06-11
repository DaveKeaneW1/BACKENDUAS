<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CustomerAuthenticationController extends Controller
{
    //login
    public function login()
    {
        return view('authentication.login');
    }

    //login
    public function registration()
    {
        return view('authentication.registration');
    }

    //check login
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('login')->with('success', 'Login berhasil');;
        }else{
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    //create account
    public function create_account(Request $request)
    {
        return redirect()->route('authentication.login')->with('success', 'Your new account has been successfully created.');
    }
}
