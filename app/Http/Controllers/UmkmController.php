<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemilikUmkm;
use App\Models\DataUsaha;
use App\Models\LegalitasUsaha;
use App\Models\KategoriJenisUsaha;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
    public function showForm()
    {
        // Ambil semua jenis usaha untuk dropdown
        $jenisUsaha = KategoriJenisUsaha::all();
        return view('umkm.daftar-umkm', compact('jenisUsaha'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Step 1: Pemilik
            'nama_lengkap' => 'required|string|max:150',
            'nik' => 'required|size:16',
            'no_hp' => 'required|string|max:20',
            'alamat_domisili' => 'required|string',

            // Step 2: Usaha
            'nama_usaha' => 'required|string|max:150',
            'jenis_usaha_id' => 'required|exists:kategori_jenis_usaha,id',
            'bentuk_usaha' => 'required|string|max:50',
            'alamat_usaha' => 'required|string',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota_kabupaten' => 'required|string|max:100',
            'status_tempat' => 'required|in:milik sendiri,sewa,pinjam',

            // Step 3: Legalitas (opsional)
            'nib' => 'nullable|string|max:50',
            'iumk' => 'nullable|string|max:50',
            'sertifikat_halal' => 'nullable|string|max:100',
            'sertifikat_merek' => 'nullable|string|max:100',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // Step 1: Simpan Pemilik (ambil user_id dari login)
                $pemilik = PemilikUmkm::create([
                'nama_lengkap' => $validated['nama_lengkap'],
                'nik' => $validated['nik'],
                'no_hp' => $validated['no_hp'],
                'alamat_domisili' => $validated['alamat_domisili'],
                'email' => auth()->user()->email, // ambil email dari akun login
            ]);


                // Step 2: Simpan Data Usaha
                $usaha = DataUsaha::create([
                    'pemilik_id' => $pemilik->id,
                    'nama_usaha' => $validated['nama_usaha'],
                    'jenis_usaha_id' => $validated['jenis_usaha_id'],
                    'bentuk_usaha' => $validated['bentuk_usaha'],
                    'alamat_usaha' => $validated['alamat_usaha'],
                    'desa_kelurahan' => $validated['desa_kelurahan'],
                    'kecamatan' => $validated['kecamatan'],
                    'kota_kabupaten' => $validated['kota_kabupaten'],
                    'status_tempat' => $validated['status_tempat'],
                ]);

                // Step 3: Simpan Legalitas
                LegalitasUsaha::create([
                    'usaha_id' => $usaha->id,
                    'nib' => $validated['nib'] ?? null,
                    'iumk' => $validated['iumk'] ?? null,
                    'sertifikat_halal' => $validated['sertifikat_halal'] ?? null,
                    'sertifikat_merek' => $validated['sertifikat_merek'] ?? null,
                ]);
            });

            return redirect()->route('umkm.form')->with('success', 'Data UMKM berhasil disimpan!');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
