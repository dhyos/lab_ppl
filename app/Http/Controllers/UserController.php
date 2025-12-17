<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updatePassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Konfirmasi harus cocok dengan new_password_confirmation
        ]);

        $user = Auth::user();

        // 2. Cek apakah password lama cocok dengan yang di database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama Anda salah!');
        }

        // 3. Update Password Baru
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}