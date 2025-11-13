@extends('layouts.umkm')

@section('title', 'Tambah Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-10">
  <div class="content-card">
    <h2 class="section-title-gradient">Tambah Produk Baru</h2>
    <p style="text-align:center; color:#6b7280; margin-bottom:1.5rem;">
      Lengkapi data produk Anda agar tampil di dashboard UMKM.
    </p>

    {{-- ✅ Alert --}}
    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

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
        <label for="kategori_id">Kategori Produk</label>
        <select name="kategori_id" id="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori_produk as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>


      {{-- Harga --}}
      <div class="form-group">
        <label class="form-label">Harga (Rp) <span class="required">*</span></label>
        <input type="number" name="harga" class="form-input"
               placeholder="Contoh: 15000" step="0.01" required
               value="{{ old('harga') }}">
      </div>

      {{-- Foto Produk --}}
      <div class="form-group form-group-full">
        <label class="form-label">Foto Produk (maks. 1 file)</label>
        <input type="file" name="foto_produk" class="form-input" accept="image/*">
      </div>

      {{-- Deskripsi --}}
      <div class="form-group form-group-full">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-input" rows="3"
                  placeholder="Tuliskan deskripsi produk...">{{ old('deskripsi') }}</textarea>
      </div>

      {{-- Status --}}
      <div class="form-group">
        <label class="form-label">Status</label>
        <select name="status_produk" class="form-input">
          <option value="aktif" {{ old('status_produk') == 'aktif' ? 'selected' : '' }}>Aktif</option>
          <option value="nonaktif" {{ old('status_produk') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      {{-- Tombol --}}
      <div style="display:flex; justify-content:space-between; margin-top:1.5rem;">
        <a href="{{ route('umkm.dashboard', ['id' => $usaha->id]) }}" class="btn-secondary">
        ← Kembali
        </a>


        <button type="submit" class="btn-primary">
          Simpan Produk
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
