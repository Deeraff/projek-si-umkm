<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DataUsaha;
use App\Models\PemilikUmkm;
use App\Models\Announcement;
use App\Models\Faq;

class LandingPageController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->take(3)->get();
        $faqs = Faq::latest()->take(3)->get();

        $hasUmkm = false;
        $daftarUmkm = collect();
        $umkmId = null; // 🔹 Tambahkan inisialisasi agar aman

        if (Auth::check()) {
            $pemilik = PemilikUmkm::where('email', Auth::user()->email)->first();

            if ($pemilik) {
                $daftarUmkm = DataUsaha::where('pemilik_id', $pemilik->id)
                    ->latest()
                    ->get();

                $hasUmkm = $daftarUmkm->isNotEmpty();

                // 🔹 Ambil ID usaha pertama untuk tombol "Lihat UMKM"
                $umkmPertama = $daftarUmkm->first();
                $umkmId = $umkmPertama ? $umkmPertama->id : null;
            }
        } else {
            $daftarUmkm = DataUsaha::with('jenisUsaha', 'pemilik')
                ->latest()
                ->take(6)
                ->get();
        }

        // 🔹 Kirim variabel tambahan $umkmId ke view
        return view('landing-page.index', compact('announcements', 'faqs', 'hasUmkm', 'daftarUmkm', 'umkmId'));
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
