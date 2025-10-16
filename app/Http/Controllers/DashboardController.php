<?php

namespace App\Http\Controllers;

use App\Models\PemilikUmkm;
use App\Models\DataUsaha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Dashboard utama dengan statistik dan peta.
     */
    public function index()
    {
        // 🚨 LOGIKA OTORISASI: Pastikan user yang login adalah 'admin'
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman admin.'); 
        }
        
        // 1. Hitung total pemilik UMKM
        $totalPemilik = PemilikUmkm::count();
        
        // 2. Hitung UMKM Pendaftar (DataUsaha dengan status 'unverified')
        $umkmPendaftar = DataUsaha::where('status_umkm', 'unverified')->count();

        // 3. Hitung UMKM Aktif
        $umkmAktif = DataUsaha::where('status_umkm', 'verified')->count();
        
        // Ambil data UMKM untuk peta (hanya yang sudah terverifikasi atau punya koordinat)
        $data_usaha = DataUsaha::select('nama_usaha', 'alamat_usaha', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->get();

        return view('admin.dashboard', compact('totalPemilik', 'umkmPendaftar', 'umkmAktif', 'data_usaha'));
    }

    /**
     * Tampilkan daftar UMKM yang berstatus 'unverified' (Pendaftar).
     */
    public function umkmPendaftarIndex()
    {
        // Pengecekan Otorisasi Admin (Penting!)
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak. Anda bukan admin.');
        }

        // PERBAIKAN: Menggunakan nama relasi yang benar: 'jenisUsaha'
        $data_umkm = DataUsaha::with(['pemilik', 'jenisUsaha'])
            ->where('status_umkm', 'unverified')
            ->orderBy('created_at', 'asc')
            ->get(); 

        return view('admin.umkm_pendaftar', compact('data_umkm'));
    }

    /**
     * Lakukan verifikasi UMKM, mengubah status_umkm menjadi 'verified'.
     */
    public function verify(DataUsaha $umkm)
    {
        // Pengecekan Otorisasi Admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }

        $umkm->status_umkm = 'verified';
        $umkm->save();

        return redirect()->route('admin.umkm.pendaftar.index')->with('success', 'UMKM ' . $umkm->nama_usaha . ' berhasil diverifikasi.');
    }

    /**
     * Tampilkan detail UMKM.
     */
    public function show(DataUsaha $umkm)
    {
        // Pengecekan Otorisasi Admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
        
        // Asumsi ada view detail, Anda bisa mengembangkannya di sini.
        // return view('admin.umkm_detail', compact('umkm'));
        return redirect()->back()->with('info', 'Halaman detail UMKM belum diimplementasikan.');
    }

    /**
     * Hapus data UMKM.
     */
    public function destroy(DataUsaha $umkm)
    {
        // Pengecekan Otorisasi Admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
        
        $nama = $umkm->nama_usaha;
        $umkm->delete();

        return redirect()->route('admin.umkm.pendaftar.index')->with('success', 'UMKM ' . $nama . ' berhasil dihapus.');
    }
}
