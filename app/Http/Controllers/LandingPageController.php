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
        // Ambil pengumuman & FAQ
        $announcements = Announcement::latest()->take(3)->get();
        $faqs = Faq::take(5)->get();

        // Ambil daftar UMKM (misalnya 6 terbaru)
        $daftarUmkm = DataUsaha::latest()->take(6)->get();

        $hasUmkm = false;

        if (Auth::check()) {
            $pemilik = PemilikUmkm::where('email', Auth::user()->email)->first();

            if ($pemilik) {
                $hasUmkm = DataUsaha::where('pemilik_id', $pemilik->id)->exists();
            }
        }

        // Kirim data ke view
        return view('landing-page.index', compact('announcements', 'faqs', 'hasUmkm', 'daftarUmkm'));
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
