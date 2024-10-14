<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke dashboard atau halaman lain
            return redirect()->intended('dashboard');
        } else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['login_error' => 'Username atau password salah.']);
        }
    }
}
