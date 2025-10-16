<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriJenisUsaha;

class InformasiController extends Controller
{
    public function showKuliner(Request $request)
    {
        // cari kategori "makanan & minuman" dari tabel kategori_jenis_usaha
        $kategori = KategoriJenisUsaha::where('nama_jenis', 'makanan & minuman')->first();

        $umkmList = collect(); // default kosong jika kategori tidak ditemukan

        if ($kategori) {
            $query = $kategori->usaha();

            // jika user melakukan pencarian
            if ($request->has('search') && $request->search != '') {
                $query->where('nama_usaha', 'like', '%' . $request->search . '%');
            }

            $umkmList = $query->get();
        }

        // kirim data kategori dan daftar umkm ke view
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
