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

        $pemilik = PemilikUmkm::orderBy('nama_lengkap', 'asc')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }
}
