<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan Anda mengimpor model yang benar
use Illuminate\Support\Facades\Auth; // Impor Auth
use Illuminate\Support\Facades\Hash; // Impor Hash

class LoginController extends Controller
{
    public function halaman_login()
    {
        return view('login.login'); // Menggunakan 'login.login' untuk merujuk ke login.blade.php
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari user berdasarkan username
        $user = User::where('username', $request->username)->first(); // Ganti $users dengan $user

        // Memeriksa apakah user ditemukan
        if ($user && Hash::check($request->password, $user->password)) {
            // Jika password yang diinput cocok dengan password yang di-hash
            Auth::login($user);
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors(['loginError' => 'Username atau password salah.']);
        }
    }
}
