<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Faq;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 3 pengumuman terbaru
        $announcements = Announcement::latest()->take(3)->get();

        // Ambil 5 FAQ dari database
        $faqs = Faq::take(5)->get();

        // Kirim data ke view landing
        return view('landing-page.index', compact('announcements', 'faqs'));
    }

    // Jika kamu ingin halaman menampilkan semua pengumuman
    public function announcements()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('landing-page.announcements', compact('announcements'));
    }

    // Jika kamu ingin halaman menampilkan semua FAQ
    public function faqs()
    {
        $faqs = Faq::paginate(10);
        return view('landing-page.faqs', compact('faqs'));
    }
}
