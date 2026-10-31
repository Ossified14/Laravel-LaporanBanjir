<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporBanjirController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke form pelaporan
Route::redirect('/', '/lapor-banjir')->name('home');

// Auth (tamu saja)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    Route::get('/login', [LoginController::class, 'create'])->name('login.form');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Publik: form pelaporan (tanpa login) 
Route::get('/lapor-banjir', [LaporBanjirController::class, 'create'])
    ->name('laporbanjir.create');

Route::post('/lapor-banjir', [LaporBanjirController::class, 'store'])
    ->name('laporbanjir.store');

// Dilindungi: hanya petugas login
Route::middleware('auth')->group(function () {
    Route::get('/daftar-laporan', [LaporBanjirController::class, 'index'])
        ->name('laporbanjir.index');

    Route::get('/profil', [HomeController::class, 'profile'])
        ->name('profile');
});