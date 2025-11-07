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
    public function umkmPendaftarIndex(Request $request)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak. Anda bukan admin.');
        }
    
        // Ambil input dari form
        $search = $request->input('search');
        $status = $request->input('status_umkm');
    
        // Query utama dengan relasi
        $query = DataUsaha::with(['pemilik', 'jenisUsaha']);
    
        // Filter status (default: unverified)
        if (!empty($status) && $status !== 'semua') {
            $query->where('status_umkm', $status);
        } else {
            $query->where('status_umkm', 'unverified'); // default tampilan awal
        }
    
        // Filter pencarian nama usaha
        if (!empty($search)) {
            $query->where('nama_usaha', 'like', '%' . $search . '%');
        }
    
        // Urutkan dari paling baru
        $data_umkm = $query->orderBy('created_at', 'desc')->get();
    
        return view('admin.umkm.umkm_pendaftar', compact('data_umkm'));
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
    public function show($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
    
        // Hapus 'dataUsaha' karena model ini sudah DataUsaha
        $umkm = DataUsaha::with(['jenisUsaha', 'pemilik', 'legalitasUsaha'])->findOrFail($id);
    
        return view('admin.umkm.show', compact('umkm'));
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
