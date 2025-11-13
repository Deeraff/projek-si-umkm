@extends('layouts.umkm')

@section('title', 'Edit Produk')

@section('content')
<div class="landing-container py-10">
    <div class="content-card max-w-4xl mx-auto">
        <h2 class="section-title-gradient text-center mb-6">Edit Data Produk</h2>

        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- NAMA PRODUK --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-input w-full border rounded px-3 py-2" 
                           value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>

                {{-- KATEGORI --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Kategori Produk</label>
                    <select name="kategori_id" class="form-input w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STATUS PRODUK --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Status Produk</label>
                    <select name="status_produk" class="form-input w-full border rounded px-3 py-2" required>
                        <option value="aktif" {{ $produk->status_produk === 'aktif' ? 'selected' : '' }}>Aktif (Tersedia)</option>
                        <option value="nonaktif" {{ $produk->status_produk === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                {{-- HARGA --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-input w-full border rounded px-3 py-2"
                           value="{{ old('harga', $produk->harga) }}" required>
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-input w-full border rounded px-3 py-2" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                {{-- FOTO PRODUK --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Foto Produk</label>
                    @if($produk->foto_produk)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" 
                                 alt="Foto Produk" 
                                 class="w-24 h-24 object-cover rounded border">
                        </div>
                    @endif
                    <input type="file" name="foto_produk" class="form-input w-full border rounded px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
                </div>

            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('produk.show', $produk->id) }}" 
                   class="btn-secondary bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" 
                        class="btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
