<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect sesuai role demi keamanan UAS
            if (Auth::user()->role === 'super_admin' || Auth::user()->role === 'staf') {
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/'); // Customer ke landing page
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Register Customer
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max::255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default pendaftar baru adalah customer
        ]);

        return redirect()->route('login')->with('success', 'Registrasi sukses! Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}