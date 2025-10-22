<?php

namespace App\Http\Controllers;

use App\Models\KategoriJenisUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriJenisUsahaController extends Controller
{
    /**
     * Tampilkan daftar Kategori Jenis Usaha.
     */
    public function index()
    {
        // Pengecekan Otorisasi Admin (Penting!)
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak. Anda bukan admin.');
        }

        // Ambil semua data kategori, diurutkan berdasarkan nama
        $data_kategori = KategoriJenisUsaha::orderBy('nama_jenis', 'asc')->get();

        return view('admin.kategori.index', compact('data_kategori'));
    }

    /**
     * Tampilkan form untuk membuat Kategori baru.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
        
        return view('admin.kategori.create');
    }

    /**
     * Simpan Kategori baru ke database.
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
    
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:kategori_jenis_usaha,nama_jenis',
            'deskripsi' => 'nullable|string',
        ]);
    
        KategoriJenisUsaha::create([
            'nama_jenis' => $request->nama_jenis,
            'deskripsi' => $request->deskripsi, // ✅ perbaikan di sini
        ]);
    
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit Kategori.
     */
    public function edit(KategoriJenisUsaha $kategori)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
        
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui Kategori di database.
     */
    public function update(Request $request, KategoriJenisUsaha $kategori)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }
    
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:kategori_jenis_usaha,nama_jenis,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);
    
        $kategori->update([
            'nama_jenis' => $request->nama_jenis,
            'deskripsi' => $request->deskripsi, // ✅ perbaikan di sini
        ]);
    
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ' . $kategori->nama_jenis . ' berhasil diperbarui.');
    }

    /**
     * Hapus Kategori dari database.
     */
    public function destroy(KategoriJenisUsaha $kategori)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }

        $nama = $kategori->nama_jenis;
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ' . $nama . ' berhasil dihapus.');
    }
}
