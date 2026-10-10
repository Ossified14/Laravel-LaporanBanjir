<?php

use App\Http\Controllers\LaporBanjirController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke form pelaporan
Route::redirect('/', '/lapor-banjir')->name('home');

// Halaman form pelaporan banjir
Route::get('/lapor-banjir', [LaporBanjirController::class, 'create'])
    ->name('laporbanjir.create');

// Proses pengiriman laporan banjir
Route::post('/lapor-banjir', [LaporBanjirController::class, 'store'])
    ->name('laporbanjir.store');

// Halaman daftar laporan
Route::get('/daftar-laporan', [LaporBanjirController::class, 'index'])
    ->name('laporbanjir.index');