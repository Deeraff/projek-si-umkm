<?php

namespace App\Http\Controllers;

use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikUmkmController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
    
        // Gunakan pagination (10 data per halaman)
        $pemilik = PemilikUmkm::orderBy('nama_lengkap', 'asc')
                    ->paginate(5)
                    ->withQueryString(); // agar tetap menyimpan parameter pencarian jika ditambah nanti
    
        return view('admin.pemilik.index', compact('pemilik'));
    }    
}
