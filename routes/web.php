<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ContactController; // WAJIB ADA
use App\Http\Controllers\KategoriJenisUsahaController;
use App\Http\Controllers\PemilikUmkmController;
use App\Http\Controllers\PendudukController;

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
    Route::get('/daftar-umkm', [UmkmController::class, 'showForm'])->name('umkm.form');
    Route::post('/daftar-umkm', [UmkmController::class, 'store'])->name('umkm.store');
    Route::get('/umkm', [UmkmController::class, 'index'])->name('kelola.umkm');
    Route::post('/umkm/reset-status/{usaha_id}', [UmkmController::class, 'resetStatus'])->name('umkm.reset_status');
    Route::get('/umkm/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/umkm/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/list', [ProdukController::class, 'list'])->name('produk.list');
    Route::get('/umkm/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


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
        Route::get('/umkm/umkm-pendaftar', [DashboardController::class, 'umkmPendaftarIndex'])->name('umkm.pendaftar.index');
        Route::patch('/umkm/{umkm}/verify', [DashboardController::class, 'verify'])->name('umkm.verify');
        Route::get('/umkm/{umkm}/show', [DashboardController::class, 'show'])->name('umkm.show');
        Route::patch('/umkm/{id}/tolak', [DashboardController::class, 'reject'])->name('umkm.reject');
        Route::resource('kategori', KategoriJenisUsahaController::class)->names([
            'index'   => 'kategori.index',
            'create'  => 'kategori.create',
            'store'   => 'kategori.store',
            'edit'    => 'kategori.edit',
            'update'  => 'kategori.update',
            'destroy' => 'kategori.destroy',
        ]);
        Route::resource('pemilik', PemilikUmkmController::class)->names([
            'index'   => 'pemilik.index',
            'create'  => 'pemilik.create',
            'store'   => 'pemilik.store',
            'edit'    => 'pemilik.edit',
            'update'  => 'pemilik.update',
            'destroy' => 'pemilik.destroy',
        ]);
        Route::resource('penduduk', PendudukController::class)->names([
            'index'   => 'penduduk.index',
            'create'  => 'penduduk.create',
            'store'   => 'penduduk.store',
            'edit'    => 'penduduk.edit',
            'update'  => 'penduduk.update',
            'destroy' => 'penduduk.destroy',
        ]);
});

Route::get('/informasi/kuliner', [InformasiController::class, 'showKuliner'])->name('informasi.kuliner');
Route::get('/informasi/kerajinan', [InformasiController::class, 'showKerajinan'])->name('informasi.kerajinan');
Route::get('/informasi/pelatihan', [InformasiController::class, 'showPelatihan'])->name('informasi.pelatihan');

use App\Http\Controllers\DashboardUmkmController;

Route::get('/umkm/dashboard/{id}', [DashboardUmkmController::class, 'index'])
    ->name('umkm.dashboard');

    
