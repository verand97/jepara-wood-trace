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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auto-create default admin for testing if it doesn't exist
        if ($credentials['email'] === 'admin@jeparawoodtrace.com' && !User::where('email', 'admin@jeparawoodtrace.com')->exists()) {
            User::create([
                'name' => 'Admin Jepara',
                'email' => 'admin@jeparawoodtrace.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'is_admin' => true
            ]);
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk sebagai Admin.');
            }

            return redirect()->route('orders.history')->with('success', 'Berhasil masuk.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('orders.history')->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
