@extends('layouts.app')

@section('title', 'Detail Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-10">
  <div class="content-card" style="max-width:850px; margin:auto; padding:2rem 2.5rem;">

    {{-- 🔙 Tombol Kembali --}}
    <a href="{{ $umkm ? route('umkm.dashboard', ['id' => $umkm->id]) : route('landing.index') }}" 
       class="btn-secondary"
       style="margin-bottom:1.5rem; display:inline-flex; align-items:center; gap:.4rem; font-weight:500;">
       ← Kembali ke Dashboard
    </a>

    {{-- 🖼️ Foto & Info Produk --}}
    <div style="display:flex; flex-wrap:wrap; gap:2rem; align-items:flex-start;">

      {{-- Foto Produk --}}
      <div style="flex:0 0 280px;">
        <img src="{{ $produk->foto_produk 
            ? asset('storage/' . $produk->foto_produk) 
            : asset('images/default-product.png') }}"
            alt="{{ $produk->nama_produk }}"
            style="width:100%; height:280px; object-fit:cover; border-radius:14px; border:2px solid #e5e7eb; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
      </div>

      {{-- Detail Produk --}}
      <div style="flex:1;">
        <h1 style="margin:0; font-size:1.75rem; color:#111827; font-weight:700;">
          {{ $produk->nama_produk }}
        </h1>

        <p style="font-size:1.4rem; color:#2563eb; font-weight:600; margin:.5rem 0 1rem;">
          Rp {{ number_format($produk->harga, 0, ',', '.') }}
        </p>

        <p style="color:#4b5563; margin:.3rem 0;">
          <strong>Status:</strong> 
          <span style="color:{{ $produk->status_produk === 'aktif' ? '#16a34a' : '#dc2626' }}; font-weight:600;">
            {{ $produk->status_produk === 'aktif' ? 'Tersedia' : 'Nonaktif' }}
          </span>
        </p>

        <p style="color:#4b5563; margin:.3rem 0;">
          <strong>Kategori:</strong> 
          <span style="color:#374151;">
            {{ $produk->kategori->nama_kategori ?? 'Tidak ada kategori' }}
          </span>
        </p>

        <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid #e5e7eb;">
          <p style="color:#374151; line-height:1.7; white-space:pre-line;">
            {{ $produk->deskripsi ?? 'Belum ada deskripsi produk.' }}
          </p>
        </div>
      </div>
    </div>

    {{-- ⚙️ Tombol Aksi --}}
    <div style="margin-top:2.5rem; display:flex; gap:1rem; justify-content:flex-end;">
      <a href="{{ route('produk.edit', $produk->id ?? '#') }}" 
         class="btn-primary"
         style="padding:.6rem 1.2rem; border-radius:8px; font-weight:500;">
         Edit Produk
      </a>

      <form action="{{ route('produk.destroy', $produk->id ?? '#') }}" 
            method="POST" 
            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn-danger"
                style="padding:.6rem 1.2rem; border-radius:8px; font-weight:500;">
          Hapus
        </button>
      </form>
    </div>

  </div>
</div>
@endsection
