<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        if (Auth::guard('customer')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('home')->with('success', 'Login berhasil');;
        } else {
            return redirect()
            ->back()
            ->withErrors('Username atau password salah.')
            ->withInput();
        }
    }

    //create account
    public function create_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:8',
            'noHp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Validation passed, create the customer
        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noHp' => $request->noHp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('authentication.login')->with('success', 'Your new account has been successfully created.');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
