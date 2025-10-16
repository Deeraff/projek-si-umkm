@extends('layouts.app')

@section('title', 'Detail UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-10">

    {{-- Judul utama --}}
    <h2 class="section-title-gradient">Detail UMKM</h2>

    {{-- Card utama --}}
    <div class="umkm-detail-card">

        <div class="flex flex-col md:flex-row gap-8 items-center">
            {{-- Logo UMKM --}}
            @if($usaha->logo)
                <img src="{{ asset('storage/' . $usaha->logo) }}" alt="Logo UMKM"
                    class="w-48 h-48 object-cover rounded-lg border-2 border-green-500 shadow-md">
            @else
                <div class="w-48 h-48 flex items-center justify-center rounded-lg bg-gray-100 border border-gray-300 text-gray-400">
                    <i class="bi bi-image" style="font-size:2rem;"></i>
                </div>
            @endif

            {{-- Informasi umum --}}
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-green-700 mb-3">{{ $usaha->nama_usaha }}</h3>
                <div class="umkm-info-grid">
                    <div class="umkm-info-item">
                        <strong>Nama Pemilik</strong>
                        <span>{{ $usaha->pemilik->nama_lengkap ?? '-' }}</span>
                    </div>
                    <div class="umkm-info-item">
                        <strong>Jenis Usaha</strong>
                        <span>{{ $usaha->jenisUsaha->nama_jenis ?? '-' }}</span>
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
                        <span>{{ ucfirst($usaha->status_tempat ?? '-') }}</span>
                    </div>
                    <div class="umkm-info-item">
                        <strong>Tenaga Kerja</strong>
                        <span>L: {{ $usaha->tenaga_kerja_l ?? 0 }}, P: {{ $usaha->tenaga_kerja_p ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol kembali --}}
    <div class="text-center mt-8">
        <a href="{{ url('/') }}" class="btn-secondary inline-flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

</div>
@endsection
