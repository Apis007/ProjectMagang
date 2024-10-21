<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RedamanController;
use App\Http\Controllers\TeknisiController;

// Rute untuk halaman welcome
Route::get('/', function () {
    return view('pelanggan.index');
});

// Rute untuk halaman login (GET)
Route::get('/login', [LoginController::class, 'halaman_login']);

// Rute untuk memproses login (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rute untuk dashboard dengan middleware auth
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');  // Tampilan halaman dashboard
// })->middleware('auth');  // Hanya bisa diakses jika sudah login

Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// Routes for Teknisi management
Route::get('teknisi', [TeknisiController::class, 'index'])->name('teknisi.index');
Route::post('teknisi/store', [TeknisiController::class, 'store'])->name('teknisi.store');
Route::post('teknisi/edit/{id}', [TeknisiController::class, 'edit'])->name('teknisi.edit');
Route::put('teknisi/update/{id}', [TeknisiController::class, 'update'])->name('teknisi.update');
Route::delete('teknisi/destroy/{id}', [TeknisiController::class, 'destroy'])->name('teknisi.destroy');

Route::post('/redaman/import', [RedamanController::class, 'import'])->name('redaman.import');
Route::get('redaman', [RedamanController::class, 'index'])->name('redaman.index');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
