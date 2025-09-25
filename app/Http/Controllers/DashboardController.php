<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil data UMKM + profilnya
        $umkm = Umkm::with('profil')->get();

        return view('dashboard.index', compact('umkm'));
    }
}

