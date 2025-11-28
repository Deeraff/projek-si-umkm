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
        $announcements = Announcement::latest()->take(3)->get();
        $faqs = Faq::latest()->take(3)->get();

        $filter = $request->get('filter');    // terpopuler / 24jam / khas
        $search = $request->get('search');    // pencarian nama usaha

        // ===== DEFAULT DATA UMKM (untuk guest) =====
        $query = DataUsaha::query()->with('jenisUsaha', 'pemilik');

        // =============== SEARCH ===============
        if ($search) {
            $query->where('nama_usaha', 'like', '%' . $search . '%');
        }

        // =============== FILTER ===============
        if ($filter == 'popular') {
            // berdasarkan views terbanyak
            $query->orderBy('views', 'desc');
        }

        if ($filter == '24jam') {
            // UMKM yang buka 24 jam
            $query->where('jam_buka', '00:00')->where('jam_tutup', '00:00');
        }

        if ($filter == 'khas') {
            // kategori kuliner khas sukorame
            $query->where('kategori', 'Kuliner Khas Sukorame');
        }

        // DEFAULT: ambil 6 UMKM
        $daftarUmkm = $query->latest()->take(30)->get();

        // ==== Untuk user yang login sebagai pemilik ====
        $hasUmkm = false;
        $umkmId = null;

        if (Auth::check()) {
            $pemilik = PemilikUmkm::where('email', Auth::user()->email)->first();

            if ($pemilik) {
                $daftarUmkm = DataUsaha::where('pemilik_id', $pemilik->id)
                    ->latest()
                    ->get();

                $hasUmkm = $daftarUmkm->isNotEmpty();
                $umkmPertama = $daftarUmkm->first();
                $umkmId = $umkmPertama ? $umkmPertama->id : null;
            }
        }

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
        $faqs = Faq::paginate(10);
        return view('landing-page.faqs', compact('faqs'));
    }
}
