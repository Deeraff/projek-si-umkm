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
    
        // 2. Hitung UMKM Pendaftar (status = unverified)
        $umkmPendaftar = DataUsaha::where('status_umkm', 'unverified')->count();
    
        // 3. Hitung UMKM Aktif (status = verified)
        $umkmAktif = DataUsaha::where('status_umkm', 'verified')->count();
    
        // 4. Ambil data UMKM untuk peta (hanya yang sudah terverifikasi dan punya koordinat)
        $data_usaha = DataUsaha::select('nama_usaha', 'alamat_usaha', 'latitude', 'longitude')
            ->where('status_umkm', 'verified') // ✅ hanya tampilkan UMKM terverifikasi
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
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
    public function verify($id)
    {
        // Pengecekan Otorisasi Admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }

        $pendaftar = DataUsaha::findOrFail($id);
        $pendaftar->update(['status_umkm' => 'verified']);
    
        // Pindahkan ke tabel data_usaha jika belum ada
        DataUsaha::firstOrCreate(
            ['pemilik_id' => $pendaftar->pemilik_id],
            [
                'nama_usaha' => $pendaftar->nama_usaha,
                'deskripsi' => $pendaftar->deskripsi,
                'status_umkm' => 'aktif'
            ]
        );
    
        return redirect()->back()->with('success', 'UMKM berhasil diverifikasi!');
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
    public function reject(Request $request, $id)
    {
        // Pengecekan Otorisasi Admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
        
        $request->validate([
            'alasan_tolak' => 'required|string|max:255',
        ]);
    
        $pendaftar = DataUsaha::findOrFail($id);
        $pendaftar->update([
            'status_umkm' => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak
        ]);
    
        return redirect()->back()->with('error', 'UMKM ditolak dengan alasan: ' . $request->alasan_tolak);
    }
}
