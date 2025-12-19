@extends('layouts.umkm')

@section('title', 'Menunggu Verifikasi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container py-5">

    <div class="text-center">

        <i class="fas fa-hourglass-half fa-4x text-warning mb-3"></i>

        <h2 class="section-title-gradient">Menunggu Verifikasi Admin</h2>

        <p class="text-muted mt-3">
            Terima kasih telah mendaftarkan UMKM Anda.
            Saat ini data usaha <strong>{{ $usaha->nama_usaha }}</strong> sedang dalam proses verifikasi.
        </p>

        <!-- Card menggunakan style content-card bawaan -->
        <div class="content-card mx-auto mt-4" style="max-width:520px;">
            <h5 class="card-title">Detail Pendaftaran</h5>

            <ul class="list-group list-group-flush">
                <li class="list-group-item py-3">
                    <strong>Nama Usaha:</strong> {{ $usaha->nama_usaha }}
                </li>

                <li class="list-group-item py-3">
                    <strong>Kategori:</strong> {{ $usaha->jenisUsaha->nama_jenis ?? '-' }}
                </li>

                <li class="list-group-item py-3">
                    <strong>Alamat Usaha:</strong> {{ $usaha->alamat_usaha }}
                </li>

                <li class="list-group-item py-3">
                    <strong>Status:</strong>
                    <span class="badge bg-warning text-dark">Belum Diverifikasi</span>
                </li>
            </ul>
        </div>

        <p class="text-muted mt-4">
            Anda akan mendapatkan notifikasi setelah verifikasi selesai.
        </p>
        
    </div>
</div>
@endsection
