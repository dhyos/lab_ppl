<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // LOGIKA PENGECEKAN ROLE
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
    
            return redirect()->intended('/dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Tampilkan Form Register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request) {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // 2. Buat User Baru
        User::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // Otomatis jadi user
        ]);

        // 3. Redirect ke Login dengan Pesan Sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.dashboard');
    }
}