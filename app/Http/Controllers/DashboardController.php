<?php

namespace App\Http\Controllers;

use App\Models\PemilikUmkm;
use App\Models\DataUsaha;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total pemilik UMKM
        $totalPemilik = PemilikUmkm::count();    
        // 2. Hitung UMKM Pendaftar (DataUsaha dengan status 'unverified')
        $umkmPendaftar = DataUsaha::where('status_umkm', 'unverified')->count();

        // 3. Tambahkan variabel lain yang mungkin Anda butuhkan (seperti UMKM Aktif)
        $umkmAktif = DataUsaha::where('status_umkm', 'verified')->count();
        // 🎯 LOGIKA PENTING: Mendefinisikan dan mengambil data lokasi untuk peta
        $umkmLocations = DataUsaha::select('nama_usaha AS title', 'latitude AS lat', 'longitude AS lng')
            ->whereNotNull('latitude')
            ->get(); // Mengambil hasil sebagai koleksi

        // PASTIKAN $umkmLocations ada di compact()
        return view('admin.dashboard', compact('totalPemilik', 'umkmPendaftar', 'umkmAktif', 'umkmLocations'));
    }
}
