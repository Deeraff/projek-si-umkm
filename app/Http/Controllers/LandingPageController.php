<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataUsaha;
use App\Models\PemilikUmkm;
use App\Models\Announcement;
use App\Models\Faq;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data statis
        $announcements = Announcement::latest()->take(3)->get();
        $faqs = Faq::latest()->take(3)->get();

        // 2. Ambil parameter dari input form
        $filter = $request->get('filter'); // terpopuler / 24jam / khas
        $search = $request->get('search'); // kata kunci pencarian

        // 3. Bangun Query Utama untuk Daftar UMKM
        // Gunakan query pendaftar yang sudah diverifikasi (opsional tapi disarankan)
        $query = DataUsaha::query()->with(['jenisUsaha', 'pemilik']);

        // =============== LOGIKA PENCARIAN ===============
        if ($search) {
            $query->where('nama_usaha', 'like', '%' . $search . '%')
                  ->orWhere('alamat_usaha', 'like', '%' . $search . '%');
        }

        // =============== LOGIKA FILTER ===============
        if ($filter == 'terpopuler') {
            // Pastikan kolom 'views' ada di tabel data_usahas
            $query->orderBy('views', 'desc');
        } 
        elseif ($filter == '24jam') {
            // Asumsi: jam_buka & tutup 00:00 berarti 24 jam
            $query->where('jam_buka', '00:00')->where('jam_tutup', '00:00');
        } 
        elseif ($filter == 'khas') {
            // Sesuaikan dengan data kategori yang Anda punya
            $query->whereHas('jenisUsaha', function($q) {
                $q->where('nama_jenis', 'like', '%Khas%');
            });
        }

        // Ambil hasil akhir (limit 30 agar tidak terlalu berat)
        $daftarUmkm = $query->latest()->take(30)->get();

        // 4. LOGIKA PENGECEKAN KEPEMILIKAN (Untuk Tombol "LIHAT UMKM")
        // Bagian ini tidak boleh menimpa $daftarUmkm
        $hasUmkm = false;
        $umkmId = null;

        if (Auth::check()) {
            $pemilik = PemilikUmkm::where('email', Auth::user()->email)->first();
            if ($pemilik) {
                // Cek apakah pemilik ini punya usaha
                $usahaSaya = DataUsaha::where('pemilik_id', $pemilik->id)->first();
                if ($usahaSaya) {
                    $hasUmkm = true;
                    $umkmId = $usahaSaya->id;
                }
            }
        }

        // 5. Kirim ke View
        return view('landing-page.index', compact(
            'announcements',
            'faqs',
            'hasUmkm',
            'daftarUmkm',
            'umkmId',
            'filter',
            'search'
        ));
    }

    public function announcements()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('landing-page.announcements', compact('announcements'));
    }

    public function faqs()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('landing-page.faqs', compact('faqs'));
    }
}