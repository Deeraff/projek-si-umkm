{{-- resources/views/dashboard_umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container">

  {{-- HEADER --}}
  <header style="text-align: center; margin:2rem 0;">
    <h1 class="section-title-gradient">Dashboard UMKM</h1>
    <p style="text-align:center; color:#6b7280; margin-top:.5rem;">
      Profil singkat, statistik produk, dan daftar produk.
    </p>
  </header>

  <main class="content-grid">
    {{-- KIRI: PROFIL & STATISTIK --}}
    <div class="left-column">

      {{-- PROFIL SINGKAT --}}
      <section class="content-card">
        <div class="card-title">Profil Singkat</div>
        <div style="display:flex; gap:1rem; align-items:center;">
          <img id="umkm-logo"
               src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-umkm.png') }}"
               alt="logo"
               style="width:96px; height:96px; object-fit:cover; border-radius:12px; border:2px solid #e5e7eb;" />

          <div>
            {{-- NAMA USAHA --}}
            <h2 style="margin:0; font-size:1.25rem; color:var(--text-900);">
              {{ $umkm->nama_usaha ?? 'Nama UMKM' }}
            </h2>

            {{-- STATUS VERIFIKASI --}}
            <p style="margin:.25rem 0; color:#2563eb; font-weight:600;">
              Status Verifikasi:
              @if ($umkm->status_umkm === 'belum diverifikasi' || $umkm->status_umkm === 'unverified')
                <span style="color:#dc2626;">Belum Diverifikasi</span>
              @elseif ($umkm->status_umkm === 'diverifikasi' || $umkm->status_umkm === 'verified')
                <span style="color:#16a34a;">Terverifikasi</span>
              @else
                <span style="color:#6b7280;">Tidak Diketahui</span>
              @endif
            </p>

            {{-- BENTUK USAHA --}}
            <p style="margin:.25rem 0; color:#374151;">
              {{ $umkm->bentuk_usaha ?? 'Bentuk usaha belum diisi.' }}
            </p>

            {{-- ALAMAT --}}
            <p style="margin:.25rem 0; color:#6b7280; font-weight:600;">
              Alamat:
              <span style="font-weight:400;">
                {{ $umkm->alamat_usaha ?? 'Belum ada alamat.' }}
              </span>
            </p>

            {{-- TELEPON --}}
            <p style="margin:.25rem 0; color:#6b7280; font-weight:600;">
              No. Telepon:
              <span style="font-weight:400;">
                {{ $umkm->no_telp_usaha ?? '-' }}
              </span>
            </p>
            
            {{-- BAGIAN PENTING: Link ini mengarah ke detail profil --}}
            <a href="{{ route('umkm.profil.detail', ['id' => $umkm->id]) }}" class="btn-secondary" style="margin-top:.5rem; display:inline-block;">
                Lihat Profil Lengkap
            </a>

          </div>
        </div>
      </section>

      {{-- STATISTIK --}}
      <section class="content-card umkm-statistik">
        <div class="card-title">Statistik</div>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
          <div class="statistik-card">
            <div style="font-size:.9rem; opacity:.9;">Jumlah Produk</div>
            <div id="stat-jumlah-produk" class="statistik-value">
              {{ isset($products) ? $products->count() : 0 }}
            </div>
          </div>
          <div class="statistik-card" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">
            <div style="font-size:.9rem; opacity:.9;">Produk Aktif</div>
            <div id="stat-produk-aktif" class="statistik-value">
              {{ $products->where('aktif', true)->count() ?? 0 }}
            </div>
          </div>
        </div>
      </section>
    </div>

    {{-- KANAN: DAFTAR PRODUK --}}
    <aside>
      <section class="content-card">
        <div class="card-title" style="display:flex; justify-content:space-between; align-items:center;">
          <span>Daftar Produk</span>
          {{-- 🔘 TOMBOL TAMBAH PRODUK --}}
          <a href="{{ route('produk.create', ['data_usaha_id' => $umkm->id]) }}"
             class="btn-primary"
             style="padding:.4rem .8rem; border-radius:8px; background:#2563eb; color:white; font-size:.9rem; text-decoration:none;">
            + Tambah Produk
          </a>
        </div>

        {{-- FILTER --}}
        <div style="display:flex; gap:.5rem; margin-bottom:1rem;">
          <input id="search" class="form-input" placeholder="Cari produk..." style="flex:1;" />
          <select id="filter-kategori" class="form-input" style="width:160px;">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $kategori)
              <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
          </select>

        </div>

        <div id="produk-list" class="umkm-grid">
        @forelse($products as $p)
          <div class="umkm-card">
            <img class="umkm-card-image"
                src="{{ $p->foto_produk ? asset('storage/' . $p->foto_produk) : asset('images/default-product.png') }}"
                alt="{{ $p->nama_produk }}">


            <div class="umkm-card-title">{{ $p->nama_produk }}</div>

            <div class="umkm-card-info">
              <span class="umkm-card-info-text">
                Harga: Rp {{ number_format($p->harga, 0, ',', '.') }}
              </span>
            </div>

            <div class="umkm-card-info">
              <span class="umkm-card-info-text">
                Status: {{ $p->status_produk === 'aktif' ? 'Tersedia' : 'Nonaktif' }}
              </span>
            </div>

            <a href="{{ route('produk.show', $p->id) }}" class="umkm-card-link">
              Lihat detail →
            </a>

          </div>
        @empty
          <div class="empty-message">Belum ada produk terdaftar.</div>
        @endforelse
      </div>

        <div class="see-more-container">
          <a href="#" class="see-more-link">Muat lebih banyak &rarr;</a>
        </div>
      </section>
    </aside>
  </main>
</div>
@endsection