<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataProduk;
use App\Models\PemilikUmkm;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // 🧩 Form tambah produk
    public function create()
    {
        $user = Auth::user();
        $pemilik = PemilikUmkm::where('email', $user->email)->with('usaha')->first();

        if (!$pemilik || !$pemilik->usaha) {
            return redirect()->route('umkm.form')->with('error', 'Anda belum memiliki data usaha.');
        }

        $kategori_produk = KategoriProduk::all();

        return view('umkm.tambah-produk', [
            'usaha' => $pemilik->usaha,
            'kategori_produk' => $kategori_produk,
        ]);
    }

    // 📤 Simpan produk baru
    public function store(Request $request)
    {
        $user = Auth::user();
        $pemilik = PemilikUmkm::where('email', $user->email)->with('usaha')->first();

        if (!$pemilik || !$pemilik->usaha) {
            return redirect()->route('umkm.form')->with('error', 'Anda belum memiliki data usaha.');
        }

        $usaha = $pemilik->usaha;

        $validated = $request->validate([
            'nama_produk'   => 'required|string|max:150',
            'kategori_id'   => 'required|exists:kategori_produk,id',
            'harga'         => 'required|numeric|min:0',
            'deskripsi'     => 'nullable|string',
            'status_produk' => 'nullable|in:aktif,nonaktif',
            'foto_produk'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto_produk')
            ? $request->file('foto_produk')->store('produk', 'public')
            : null;

        DataProduk::create([
            'nama_produk'   => $validated['nama_produk'],
            'kategori_id'   => $validated['kategori_id'],
            'harga'         => $validated['harga'],
            'deskripsi'     => $validated['deskripsi'] ?? null,
            'status_produk' => $validated['status_produk'] ?? 'aktif',
            'foto_produk'   => $fotoPath,
            'usaha_id'      => $usaha->id,
        ]);

        return redirect()->route('umkm.dashboard', $usaha->id)
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // 📋 Daftar produk
    public function list()
    {
        $user = Auth::user();
        $pemilik = PemilikUmkm::where('email', $user->email)
            ->with(['usaha.produk'])
            ->first();

        if (!$pemilik || !$pemilik->usaha) {
            return redirect()->route('umkm.form')->with('error', 'Anda belum memiliki data usaha.');
        }

        $produk = $pemilik->usaha->produk ?? collect();
        return view('umkm.produk-list', compact('produk'));
    }

    // 📄 Detail produk
    public function show($id)
    {
        $produk = DataProduk::with('kategori')->findOrFail($id);
        $umkm = $produk->usaha;

        return view('umkm.detail-produk', compact('produk', 'umkm'));
    }

    // ✏️ Edit produk
    public function edit($id)
    {
        $produk = DataProduk::findOrFail($id);
        $umkm = $produk->usaha;
        $kategoriList = KategoriProduk::all();

        return view('umkm.edit-produk', compact('produk', 'umkm', 'kategoriList'));
    }

    // 💾 Update produk
    public function update(Request $request, $id)
    {
        $produk = DataProduk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'status_produk' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk.show', $produk->id)
            ->with('success', 'Produk berhasil diperbarui!');
    }
}
