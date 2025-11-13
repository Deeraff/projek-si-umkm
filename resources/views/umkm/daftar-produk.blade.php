{{-- resources/views/umkm/produk/create.blade.php --}}
@extends('layouts.umkm')

@section('title', 'Tambah Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-10">
  <div class="content-card" style="max-width: 700px; margin:auto; padding:2rem 2.5rem;">
    <h2 class="section-title-gradient" style="text-align:center;">Tambah Produk Baru</h2>
    <p style="text-align:center; color:#6b7280; margin-bottom:1.5rem;">
      Lengkapi data produk Anda agar tampil di dashboard UMKM.
    </p>

    {{-- ✅ Alert --}}
    @if (session('success'))
      <div class="alert-success" style="margin-bottom:1rem;">
        {{ session('success') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="alert-danger" style="margin-bottom:1rem;">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin:.5rem 0 0 1rem; padding:0;">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- 🧾 Form Tambah Produk --}}
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
      @csrf

      {{-- Nama Produk --}}
      <div class="form-group">
        <label class="form-label">Nama Produk <span class="required">*</span></label>
        <input type="text" name="nama_produk" class="form-input"
               placeholder="Contoh: Keripik Tempe Pedas" required
               value="{{ old('nama_produk') }}">
      </div>

      {{-- Kategori --}}
      <div class="form-group">
        <label class="form-label">Kategori Produk <span class="required">*</span></label>
        <select name="kategori_id" class="form-input" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach ($kategori_produk as $kategori)
              <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
              </option>
          @endforeach
        </select>
      </div>

      {{-- Harga --}}
      <div class="form-group">
        <label class="form-label">Harga (Rp) <span class="required">*</span></label>
        <input type="number" name="harga" class="form-input"
               placeholder="Contoh: 15000" required
               value="{{ old('harga') }}">
      </div>

      {{-- Foto Produk --}}
      <div class="form-group form-group-full">
        <label class="form-label">Foto Produk</label>
        <input type="file" name="foto_produk" class="form-input" accept="image/*">
        <small style="color:#6b7280;">Format: JPG, PNG, atau JPEG (maks. 2MB)</small>
      </div>

      {{-- Deskripsi --}}
      <div class="form-group form-group-full">
        <label class="form-label">Deskripsi Produk</label>
        <textarea name="deskripsi" class="form-input" rows="3"
                  placeholder="Tuliskan deskripsi produk...">{{ old('deskripsi') }}</textarea>
      </div>

      {{-- Status --}}
      <div class="form-group">
        <label class="form-label">Status Produk</label>
        <select name="status_produk" class="form-input">
          <option value="aktif" {{ old('status_produk') == 'aktif' ? 'selected' : '' }}>Aktif</option>
          <option value="nonaktif" {{ old('status_produk') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      {{-- Tombol Aksi --}}
      <div style="display:flex; justify-content:space-between; margin-top:2rem;">
        <a href="{{ route('umkm.dashboard', ['id' => $usaha->id]) }}" 
           class="btn-secondary" 
           style="padding:.6rem 1.2rem; border-radius:8px; font-weight:500;">
          ← Kembali
        </a>

        <button type="submit" 
                class="btn-primary" 
                style="padding:.6rem 1.2rem; border-radius:8px; font-weight:500;">
          Simpan Produk
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
