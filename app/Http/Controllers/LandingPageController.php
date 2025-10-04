<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ganti baris ini dengan data dummy di bawah
        // $umkm = Umkm::with('profil')->get();

        // Buat data dummy untuk tampilan
        $umkm = collect([
            (object) [
                'id' => 1,
                'nama_umkm' => 'Toko Kopi Sejahtera',
                'logo' => null, // Biarkan null agar placeholder muncul
                'profil' => (object) [
                    'jenis_usaha' => 'Kuliner',
                    'alamat_usaha' => 'Jl. Merdeka No. 1, Bandung'
                ]
            ],
            (object) [
                'id' => 2,
                'nama_umkm' => 'Kerajinan Kayu Indah',
                'logo' => null,
                'profil' => (object) [
                    'jenis_usaha' => 'Kerajinan',
                    'alamat_usaha' => 'Jl. Pahlawan No. 5, Jakarta'
                ]
            ],
            (object) [
                'id' => 3,
                'nama_umkm' => 'Batik Nusantara',
                'logo' => null,
                'profil' => (object) [
                    'jenis_usaha' => 'Fashion',
                    'alamat_usaha' => 'Jl. Kartini No. 10, Yogyakarta'
                ]
            ],
        ]);

        return view('landing-page.index', compact('umkm'));
    }
}