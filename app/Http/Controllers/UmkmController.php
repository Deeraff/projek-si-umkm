<?php

namespace App\Http\Controllers;

use App\Models\Umkm;  
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::with('profil')->get();
        return view('umkm.index', compact('umkm'));
    }

    public function show($id)
    {
        $umkm = Umkm::with('profil')->findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }
}
