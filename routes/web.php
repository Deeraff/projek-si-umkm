<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| File ini berisi semua rute utama untuk aplikasi.
| Dibagi menjadi:
| - Public (landing page)
| - Authentication (login/register/logout)
| - Admin (dashboard & fitur internal)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Landing Page & Public Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama (beranda) — diarahkan ke landing page
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

// 📄 Halaman statis (informasi, petunjuk, kontak)
Route::prefix('landing-page')->name('landing.')->group(function () {
    Route::get('/informasi', function () {
        return view('landing-page.informasi');
    })->name('informasi');

    Route::get('/petunjuk', function () {
        return view('landing-page.petunjuk');
    })->name('petunjuk');

    Route::get('/kontak', function () {
        return view('landing-page.kontak');
    })->name('kontak');
});

// 🏪 Detail UMKM
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// 📝 Form pendaftaran UMKM
Route::middleware(['auth'])->group(function () {
    Route::get('/daftar-umkm', [UmkmController::class, 'showForm'])->name('umkm.form');
    Route::post('/daftar-umkm', [UmkmController::class, 'store'])->name('umkm.store');
    Route::get('/umkm', [UmkmController::class, 'index'])->name('kelola.umkm');
});


// 📢 Pengumuman & FAQ
Route::get('/announcements', [LandingPageController::class, 'announcements'])->name('announcements.index');
Route::get('/faqs', [LandingPageController::class, 'faqs'])->name('faqs.index');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

// 🔐 Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 🧾 Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 🚪 Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Area / Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Tambahkan route admin lainnya di sini
});
