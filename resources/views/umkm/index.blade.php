@extends('layouts.umkm')

@section('title', 'Data UMKM Saya')

@section('content')
<div class="content-card">
    <h2 class="section-title text-center">Data UMKM Terdaftar</h2>
    <p class="text-gray-600 text-center mb-6">Berikut data usaha yang telah Anda daftarkan.</p>

    {{-- ✅ Alert --}}
    @if (session('success'))
        <div class="alert alert-success" style="background:#d1fae5;color:#065f46;padding:1rem;border-radius:8px;margin-bottom:1rem;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" style="background:#fee2e2;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1rem;">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        {{-- 📋 Data Pemilik --}}
        <div class="card p-4 border rounded-lg shadow-sm">
            <h3 class="font-bold text-lg mb-3 text-green-600">Data Pemilik</h3>
            <p><strong>Nama:</strong> {{ $pemilik->nama_lengkap }}</p>
            <p><strong>NIK:</strong> {{ $pemilik->nik }}</p>
            <p><strong>No HP:</strong> {{ $pemilik->no_hp }}</p>
            <p><strong>Email:</strong> {{ $pemilik->email }}</p>
            <p><strong>Alamat Domisili:</strong> {{ $pemilik->alamat_domisili }}</p>
        </div>

        {{-- 🏢 Data Usaha --}}
        <div class="card p-4 border rounded-lg shadow-sm">
            <h3 class="font-bold text-lg mb-3 text-green-600">Data Usaha</h3>
            <p><strong>Nama Usaha:</strong> {{ $usaha->nama_usaha }}</p>
            <p><strong>Jenis Usaha:</strong> {{ $usaha->jenisUsaha->nama_jenis ?? '-' }}</p>
            <p><strong>Bentuk Usaha:</strong> {{ strtoupper($usaha->bentuk_usaha) }}</p>
            <p><strong>Alamat:</strong> {{ $usaha->alamat_usaha }}</p>
            <p><strong>No. Telepon:</strong> {{ $usaha->no_telp_usaha }}</p>
            <p><strong>Status Tempat:</strong> {{ ucfirst($usaha->status_tempat) }}</p>
            <p><strong>Tenaga Kerja:</strong> L {{ $usaha->tenaga_kerja_l }} / P {{ $usaha->tenaga_kerja_p }}</p>

            @if ($usaha->logo)
                <div class="mt-3">
                    <p><strong>Logo Usaha:</strong></p>
                    <img src="{{ asset('storage/'.$usaha->logo) }}" alt="Logo Usaha" class="w-24 h-24 object-cover rounded-md border">
                </div>
            @endif
        </div>

        {{-- 📄 Legalitas Usaha --}}
        <div class="card p-4 border rounded-lg shadow-sm md:col-span-2">
            <h3 class="font-bold text-lg mb-3 text-green-600">Legalitas Usaha</h3>
            <p><strong>NIB:</strong> {{ $legalitas->nib ?? '-' }}</p>
            <p><strong>IUMK:</strong> {{ $legalitas->iumk ?? '-' }}</p>
            <p><strong>Sertifikat Halal:</strong> {{ $legalitas->sertifikat_halal ?? '-' }}</p>
            <p><strong>Sertifikat Merek:</strong> {{ $legalitas->sertifikat_merek ?? '-' }}</p>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="#" class="btn bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            <i class="fa-solid fa-pen-to-square"></i> Edit Data UMKM
        </a>
    </div>
</div>
@endsection
