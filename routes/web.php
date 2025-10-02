<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UmkmController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/informasi', function () {
    // Arahkan ke folder 'umkm', lalu file 'informasi'
    return view('umkm.informasi'); 
});


Route::get('/petunjuk', function () {
    return view('umkm.petunjuk'); 
});


Route::get('/kontak', function () {
    return view('umkm.kontak'); 
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

