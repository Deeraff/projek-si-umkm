<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataUsaha;

class DashboardUmkmController extends Controller
{
    public function index($id)
    {
        $umkm = DataUsaha::with('jenisUsaha', 'pemilik')->find($id);

        if (!$umkm) {
            return abort(404, "Data UMKM dengan ID $id tidak ditemukan.");
        }

        $products = collect(); 

        if (class_exists('App\\Models\\Produk')) {
            $products = \App\Models\Produk::where('data_usaha_id', $id)->get();
        }

        return view('umkm.dashboard_umkm', compact('umkm', 'products'));
    }
}
