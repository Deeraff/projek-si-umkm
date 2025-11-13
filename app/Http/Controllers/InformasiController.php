<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriJenisUsaha;
use App\Models\DataUsaha;

class InformasiController extends Controller
{
    public function showKuliner(Request $request)
    {
        // cari kategori berdasarkan kolom nama_jenis
        $kategori = KategoriJenisUsaha::where('nama_jenis', 'makanan & minuman')->first();

        if ($kategori) {
            // ambil semua usaha dengan jenis tersebut
            $query = DataUsaha::where('jenis_usaha_id', $kategori->id);

            // jika ada pencarian
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('nama_usaha', 'like', "%{$search}%");
            }

            $umkmList = $query->get();
        } else {
            $umkmList = collect(); // kosong jika tidak ada kategori
        }

        return view('landing-page.detail-kuliner', compact('kategori', 'umkmList'));
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
