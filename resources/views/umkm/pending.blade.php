@extends('layouts.umkm')

@section('title', 'Menunggu Verifikasi')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <i class="fas fa-hourglass-half fa-4x text-warning mb-3"></i>
        <h2 class="text-warning fw-bold">Menunggu Verifikasi Admin</h2>
        <p class="text-muted mt-3">
            Terima kasih telah mendaftarkan UMKM Anda.  
            Saat ini data usaha <strong>{{ $usaha->nama_usaha }}</strong> sedang dalam proses verifikasi oleh tim admin.
        </p>

        <div class="card shadow-sm mx-auto mt-4" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-primary">Detail Pendaftaran</h5>
                <ul class="list-group list-group-flush text-start mt-3">
                    <li class="list-group-item"><strong>Nama Usaha:</strong> {{ $usaha->nama_usaha }}</li>
                    <li class="list-group-item"><strong>Kategori:</strong> {{ $usaha->jenisUsaha->nama_jenis ?? '-' }}</li>
                    <li class="list-group-item"><strong>Alamat Usaha:</strong> {{ $usaha->alamat_usaha }}</li>
                    <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-warning text-dark">Belum Diverifikasi</span></li>
                </ul>
            </div>
        </div>

        <p class="mt-4 text-muted">
            Anda akan mendapatkan notifikasi setelah data usaha diverifikasi.
        </p>
    </div>
</div>
@endsection
