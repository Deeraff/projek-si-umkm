<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; // Tambahkan ini jika Anda punya DashboardController

/*
|--------------------------------------------------------------------------
| Landing Page & Public Routes
|--------------------------------------------------------------------------
*/

// Rute Utama (Beranda)
// Menggunakan DashboardController atau LandingPageController yang sudah ada
Route::get('/', [LandingPageController::class, 'index'])->name('beranda'); 
// Asumsi: DashboardController.php Anda menampilkan daftar UMKM di dashboard

// Rute untuk halaman statis (Informasi, Petunjuk, Kontak)
Route::group(['as' => 'landing.'], function () {
    // Rute Informasi
    Route::get('/informasi', function () {
        return view('landing-page.informasi');
    })->name('informasi');

    // Rute Petunjuk (Diasumsikan harus mengarah ke view petunjuk.blade.php)
    Route::get('/petunjuk', function () {
        return view('landing-page.petunjuk'); 
    })->name('petunjuk');

    // Rute Kontak
    Route::get('/kontak', function () {
        return view('landing-page.kontak');
    })->name('kontak');
});

// Rute Detail UMKM
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

// Rute Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Area / Protected Routes
|--------------------------------------------------------------------------
*/

// Area Admin (Anda mungkin ingin menambahkan middleware('auth', 'admin') di sini)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Anda bisa tambahkan rute lain untuk kelola data admin di sini
});