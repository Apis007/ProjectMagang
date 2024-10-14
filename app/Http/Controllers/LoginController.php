<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function halaman_login()
    {
        // Pastikan untuk menggunakan nama tampilan yang sesuai dengan struktur folder
        return view('login.login'); // Menggunakan 'login.login' untuk merujuk ke login.blade.php
    }

    public function login(Request $request)
    {
        // Implementasi login
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ]);
    }
}
