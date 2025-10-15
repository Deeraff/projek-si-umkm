<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function showKuliner()
    {
        return view('landing-page.detail-kuliner');
    }

    public function showKerajinan()
    {
        return 'Ini adalah halaman detail untuk Kerajinan Tangan.';
    }

    public function showPelatihan()
    {
        return 'Ini adalah halaman detail untuk Pelatihan dan Workshop.';
    }
}