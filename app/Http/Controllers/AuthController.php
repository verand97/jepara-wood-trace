<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@jeparawoodtrace.com'],
            ['name' => 'Admin Jepara', 'password' => bcrypt('password')]
        );
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk secara simulasi.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
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
