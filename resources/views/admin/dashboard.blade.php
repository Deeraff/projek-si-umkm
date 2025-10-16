@extends('layouts.admin')

@section('title', 'Halaman Utama')

@section('dashboard_active', 'active') {{-- Mengaktifkan menu Dashboard di Sidebar --}}

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        {{-- Card Pengguna (Berdasarkan data pemilik_umkm yang sudah register) --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card bg-custom-blue">
                <div class="inner">
                    {{-- Mengganti angka statis '2' dengan variabel Blade --}}
                    <h3>{{ $totalPemilik ?? 0 }}</h3>
                    <p>Pemilik Akun Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                {{-- Mengganti '#' dengan route untuk daftar pemilik UMKM (jika ada) --}}
                <a href="#" class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card UMKM Pendaftar (Menampilkan dataUsaha dengan status 'unverified') --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card bg-custom-green">
                <div class="inner">
                    {{-- Mengganti angka statis '3' dengan variabel Blade --}}
                    <h3>{{ $umkmPendaftar ?? 0 }}</h3>
                    <p>UMKM Pendaftar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag"></i>
                </div>
                {{-- Asumsi route untuk halaman daftar pendaftar adalah 'admin.umkm-pendaftar.index' --}}
                <a href="#" class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card bg-custom-orange">
                <div class="inner">
                    {{-- Mengganti angka statis '1' dengan variabel Blade --}}
                    <h3>{{ $umkmAktif ?? 0 }}</h3>
                    <p>UMKM Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-university"></i>
                </div>
                {{-- Asumsi route untuk halaman daftar UMKM Aktif (Verified) --}}
                <a href="#" class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="map-card">
                <img src="https://media.wired.com/photos/59269cd37034dc5f91bec0f1/master/w_2560%2Cc_limit/GoogleMapTA.jpg"
                    alt="Peta Lokasi UMKM">
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    // Jika ada JavaScript spesifik untuk dashboard
@endsection --}}
