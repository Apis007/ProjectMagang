<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Rute untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk halaman login (GET)
Route::get('/login', [LoginController::class, 'halaman_login']);

// Rute untuk memproses login (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rute untuk dashboard dengan middleware auth
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
