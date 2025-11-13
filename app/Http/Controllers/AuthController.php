<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 🎯 ADMIN
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // 🎯 PEMILIK UMKM
            if ($user->role === 'Pemilik UMKM') {
                $pemilik = \App\Models\PemilikUmkm::where('email', $user->email)->first();

                if ($pemilik) {
                    $usaha = \App\Models\DataUsaha::where('pemilik_id', $pemilik->id)->first();

                    if ($usaha) {
                        // ✅ Langsung arahkan ke dashboard UMKM
                        return redirect()->route('dashboard.umkm', $usaha->id);
                    }
                }

                // Kalau belum punya usaha
                return redirect()->route('umkm.form')
                    ->with('info', 'Lengkapi data usaha Anda terlebih dahulu.');
            }

            // 🎯 USER BIASA
            return redirect()->route('landing.index');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }



    /**
     * Tampilkan halaman register.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role' tidak perlu divalidasi/diminta karena sudah default
        ]);
    
        // Menggunakan transaksi untuk menjamin kedua tabel tersimpan
        DB::transaction(function () use ($request) {
            
            // 1. Simpan user baru di tabel users
            // Kolom 'role' akan otomatis terisi 'Pemilik UMKM' oleh database
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'role' TIDAK perlu dimasukkan di sini jika sudah ada DEFAULT VALUE di DB
                // atau pastikan Anda tidak memasukkan 'role' di $fillable jika tidak diisi
            ]);
    
            PemilikUmkm::create([
                'email'             => $user->email, 
                'nama_lengkap'      => $request->name, 
            ]);
        });
    
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman landing setelah logout
        return redirect()->route('landing.index');
    }

}
