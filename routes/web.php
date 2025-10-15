<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController; // WAJIB ADA

/*
|--------------------------------------------------------------------------
| Web Routes
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
    
    // !!! INI ADALAH RUTE GET YANG HILANG !!!
    Route::get('/kontak', function () {
        return view('landing-page.kontak');
    })->name('kontak');
});

// 🏪 Detail UMKM
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// 📝 Form pendaftaran UMKM
Route::middleware(['auth'])->group(function () {
    Route::get('/daftar-umkm', [UmkmController::class, 'create'])->name('umkm.register');
    Route::get('/daftar-umkm', [UmkmController::class, 'showForm'])->name('umkm.form');
    Route::post('/daftar-umkm', [UmkmController::class, 'store'])->name('umkm.store');
});


// 📢 Pengumuman & FAQ
Route::get('/announcements', [LandingPageController::class, 'announcements'])->name('announcements.index');
Route::get('/faqs', [LandingPageController::class, 'faqs'])->name('faqs.index');


// =========================================================================
// Rute POST untuk Menyimpan Pesan (Harus di luar prefix landing-page)
// Form di kontak.blade.php mengarah ke sini: route('kontak.store')
// =========================================================================
Route::post('/kontak/kirim', [ContactController::class, 'store'])->name('kontak.store');


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


Route::get('/informasi/kuliner', [InformasiController::class, 'showKuliner'])->name('informasi.kuliner');
Route::get('/informasi/kerajinan', [InformasiController::class, 'showKerajinan'])->name('informasi.kerajinan');
Route::get('/informasi/pelatihan', [InformasiController::class, 'showPelatihan'])->name('informasi.pelatihan');
