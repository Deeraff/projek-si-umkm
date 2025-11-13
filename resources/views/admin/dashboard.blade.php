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
                <a href="{{ route('admin.pemilik.index') }}" class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card UMKM Pendaftar (status = unverified) --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card bg-custom-green">
                <div class="inner">
                    <h3>{{ $umkmPendaftar ?? 0 }}</h3>
                    <p>UMKM Pendaftar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag"></i>
                </div>
                <a href="{{ route('admin.umkm.pendaftar.index', ['status_umkm' => 'unverified']) }}"
                    class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card UMKM Aktif (status = verified) --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stat-card bg-custom-orange">
                <div class="inner">
                    <h3>{{ $umkmAktif ?? 0 }}</h3>
                    <p>UMKM Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-university"></i>
                </div>
                <a href="{{ route('admin.umkm.pendaftar.index', ['status_umkm' => 'verified']) }}" class="stat-card-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="map" style="height: 400px;">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Hanya data UMKM dengan status 'verified' yang dikirim dari controller
    var umkmData = @json($data_usaha ?? []);

    var defaultLat = -7.810969841181508;
    var defaultLng = 111.9921971809567;
    var initialLat = umkmData.length > 0 ? umkmData[0].latitude : defaultLat;
    var initialLng = umkmData.length > 0 ? umkmData[0].longitude : defaultLng;

    var map = L.map('map').setView([initialLat, initialLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    umkmData.forEach(function(usaha) {
        if (usaha.latitude && usaha.longitude) {
            var lat = parseFloat(usaha.latitude);
            var lng = parseFloat(usaha.longitude);

            var popupContent = `
                <b>${usaha.nama_usaha}</b><br>
                ${usaha.alamat_usaha || 'Alamat tidak tersedia'}
            `;

            L.marker([lat, lng]).addTo(map)
                .bindPopup(popupContent);
        }
    });
</script>
@endsection

