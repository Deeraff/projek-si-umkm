@extends('layouts.umkm')

@section('title', 'Data UMKM Saya')

@section('content')
<div class="landing-container py-10">
    <div class="content-card">
        <h2 class="section-title-gradient">Data UMKM Terdaftar</h2>
        <p class="text-gray-600 text-center mb-6">Berikut data usaha yang telah Anda daftarkan.</p>

        {{-- ✅ Alert --}}
        @if (session('success'))
            <div class="alert alert-success"
                style="background:#d1fae5;color:#065f46;padding:1rem;border-radius:8px;margin-bottom:1rem;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger"
                style="background:#fee2e2;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1rem;">
                {{ session('error') }}
            </div>
        @endif

        {{-- 📋 Grid data --}}
        <div class="umkm-info-grid">
            {{-- Data Pemilik --}}
            <div class="umkm-info-item">
                <strong>Nama</strong>
                <span>{{ $pemilik->nama_lengkap }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>NIK</strong>
                <span>{{ $pemilik->nik }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>No HP</strong>
                <span>{{ $pemilik->no_hp }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Email</strong>
                <span>{{ $pemilik->email }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Alamat Domisili</strong>
                <span>{{ $pemilik->alamat_domisili }}</span>
            </div>

            {{-- Data Usaha --}}
            <div class="umkm-info-item">
                <strong>Nama Usaha</strong>
                <span>{{ $usaha->nama_usaha }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Jenis Usaha</strong>
                <span>{{ $usaha->jenisUsaha->nama_jenis ?? '-' }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Bentuk Usaha</strong>
                <span>{{ strtoupper($usaha->bentuk_usaha) }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Alamat Usaha</strong>
                <span>{{ $usaha->alamat_usaha }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>No. Telepon</strong>
                <span>{{ $usaha->no_telp_usaha }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Status Tempat</strong>
                <span>{{ ucfirst($usaha->status_tempat) }}</span>
            </div>
            <div class="umkm-info-item">
                <strong>Tenaga Kerja</strong>
                <span>L: {{ $usaha->tenaga_kerja_l }} / P: {{ $usaha->tenaga_kerja_p }}</span>
            </div>

            @if ($usaha->logo)
                <div class="umkm-info-item text-center md:col-span-2">
                    <strong>Logo Usaha</strong>
                    <img src="{{ asset('storage/'.$usaha->logo) }}" alt="Logo Usaha"
                        class="w-32 h-32 object-cover rounded-md border mx-auto mt-2">
                </div>
            @endif
        </div>

        {{-- 📄 Legalitas --}}
        <div class="legalitas-section">
            <h3 class="section-title text-green-700">Legalitas Usaha</h3>
            <div class="umkm-info-grid">
                <div class="umkm-info-item">
                    <strong>NIB</strong>
                    <span>{{ $legalitas->nib ?? '-' }}</span>
                </div>
                <div class="umkm-info-item">
                    <strong>IUMK</strong>
                    <span>{{ $legalitas->iumk ?? '-' }}</span>
                </div>
                <div class="umkm-info-item">
                    <strong>Sertifikat Halal</strong>
                    <span>{{ $legalitas->sertifikat_halal ?? '-' }}</span>
                </div>
                <div class="umkm-info-item">
                    <strong>Sertifikat Merek</strong>
                    <span>{{ $legalitas->sertifikat_merek ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Tombol Edit (SUDAH DIPERBAIKI) --}}
        <div class="text-center mt-8">
            {{-- Mengarah ke route umkm.edit --}}
            <a href="{{ route('umkm.edit') }}" class="btn-secondary inline-flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit Data UMKM
            </a>
        </div>
    </div>
</div>
@endsection