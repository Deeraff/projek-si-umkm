<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataUsaha;
use App\Models\DataProduk;
use App\Models\KategoriProduk; // ✅ tambahkan ini

class DashboardUmkmController extends Controller
{
    public function index($id)
    {
        // 🔹 Ambil data UMKM berdasarkan ID dengan relasi ke jenis usaha dan pemilik
        $umkm = DataUsaha::with(['jenisUsaha', 'pemilik'])
            ->select('id', 'nama_usaha', 'bentuk_usaha', 'alamat_usaha', 'no_telp_usaha', 'logo', 'status_umkm')
            ->find($id);

        if (!$umkm) {
            abort(404, "Data UMKM dengan ID $id tidak ditemukan.");
        }

        // 🔹 Ambil semua produk UMKM ini beserta relasi kategori
        $products = DataProduk::with('kategori') // ✅ biar bisa akses nama_kategori di blade
            ->where('usaha_id', $id)
            ->get();

        // 🔹 Ambil semua kategori dari tabel kategori_produk untuk dropdown filter
        $kategoriList = KategoriProduk::all(); // ✅ tambahan penting

        // 🔹 Kirim data ke view
        return view('umkm.dashboard_umkm', compact('umkm', 'products', 'kategoriList'));
    }
}
