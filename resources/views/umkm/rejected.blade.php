@extends('layouts.umkm')

@section('title', 'UMKM Ditolak')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
        <h2 class="text-danger fw-bold">Pendaftaran UMKM Ditolak</h2>
        <p class="text-muted mt-3">
            Mohon maaf, pendaftaran UMKM Anda <strong>{{ $usaha->nama_usaha }}</strong> belum dapat diterima.
        </p>

        <div class="card shadow-sm mx-auto mt-4" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title text-danger">Alasan Penolakan</h5>
                <p class="mt-3 text-start" style="white-space: pre-line;">
                    {{ $usaha->alasan_tolak ?? 'Tidak ada keterangan dari admin.' }}
                </p>
            </div>
        </div>

        <div class="mt-5">
            <p class="text-muted mb-3">
                Silakan perbaiki data usaha Anda sesuai alasan di atas, lalu kirim ulang pendaftaran.
            </p>
            <a href="{{ route('umkm.form') }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Perbarui Data UMKM
            </a>
        </div>
    </div>
</div>
@endsection
