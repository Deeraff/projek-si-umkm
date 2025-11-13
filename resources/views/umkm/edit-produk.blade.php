@extends('layouts.app')

@section('title', 'Edit Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-10">
  <div class="content-card" style="max-width:850px; margin:auto; padding:2rem 2.5rem;">

    {{-- 🔙 Tombol Kembali --}}
    <a href="{{ route('produk.show', $produk->id) }}" 
       class="btn-secondary"
       style="margin-bottom:1.5rem; display:inline-flex; align-items:center; gap:.4rem; font-weight:500;">
       ← Kembali ke Detail Produk
    </a>

    <h1 style="font-size:1.75rem; color:#111827; font-weight:700; margin-bottom:1.5rem;">
      ✏️ Edit Produk
    </h1>

    {{-- ⚙️ Form Edit Produk --}}
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" style="display:grid; gap:1.25rem;">
      @csrf
      @method('PUT')

      {{-- Nama Produk --}}
      <div>
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-input" 
               value="{{ old('nama_produk', $produk->nama_produk) }}" required>
      </div>

      {{-- Harga --}}
      <div>
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-input"
               value="{{ old('harga', $produk->harga) }}" required>
      </div>

      {{-- Kategori --}}
      <div>
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-input" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach($kategoriList as $kategori)
            <option value="{{ $kategori->id }}" 
                    {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
              {{ $kategori->nama_kategori }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Status --}}
      <div>
        <label class="form-label">Status Produk</label>
        <select name="status_produk" class="form-input" required>
          <option value="aktif" {{ $produk->status_produk === 'aktif' ? 'selected' : '' }}>Aktif (Tersedia)</option>
          <option value="nonaktif" {{ $produk->status_produk === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="form-label">Deskripsi Produk</label>
        <textarea name="deskripsi" class="form-input" rows="5">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
      </div>

      {{-- Foto Produk --}}
      <div>
        <label class="form-label">Foto Produk</label>
        <input type="file" name="foto_produk" class="form-input">

        @if($produk->foto_produk)
          <div style="margin-top:.5rem;">
            <img src="{{ asset('storage/' . $produk->foto_produk) }}" 
                 alt="Foto Produk" 
                 style="width:120px; height:120px; object-fit:cover; border-radius:10px; border:2px solid #e5e7eb;">
          </div>
        @endif
      </div>

      {{-- Tombol Simpan --}}
      <div style="display:flex; justify-content:flex-end; gap:1rem; margin-top:1.5rem;">
        <button type="submit" 
                class="btn-primary"
                style="padding:.6rem 1.4rem; border-radius:8px; background:#2563eb; color:white; font-weight:500;">
          💾 Simpan Perubahan
        </button>
        <a href="{{ route('produk.show', $produk->id) }}" 
           class="btn-secondary"
           style="padding:.6rem 1.4rem; border-radius:8px;">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
