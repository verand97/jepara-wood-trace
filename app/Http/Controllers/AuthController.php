<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Mock login
        return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk secara simulasi.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Mock register
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan masuk.');
    }
}
