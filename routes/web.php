<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporBanjirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/lapor-banjir')->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [LoginController::class, 'create'])->name('login.form');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Publik: form pelaporan warga (tanpa login)
Route::get('/lapor-banjir', [LaporBanjirController::class, 'create'])->name('laporbanjir.create');
Route::post('/lapor-banjir', [LaporBanjirController::class, 'store'])->name('laporbanjir.store');

// Dilindungi: hanya petugas login
Route::middleware('auth')->group(function () {
    Route::get('/profil', [HomeController::class, 'profile'])->name('profile');

    // CRUD laporan oleh petugas (resource: index, show, edit, update, destroy)
    Route::resource('laporan', LaporanController::class);
});