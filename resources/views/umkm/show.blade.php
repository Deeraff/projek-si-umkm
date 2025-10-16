@extends('layouts.app')

@section('title', 'Detail UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">

{{-- ✅ Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    #map {
        width: 100%;
        height: 350px;
        border-radius: 12px;
        margin-top: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="landing-container py-10">

    <h2 class="section-title-gradient">Detail UMKM</h2>

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

                {{-- ✅ Tampilkan peta hanya kalau ada koordinat --}}
                @if($usaha->latitude && $usaha->longitude)
                    <div id="map"></div>
                @else
                    <p class="text-gray-500 mt-3 italic">Lokasi belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ url('/') }}" class="btn-secondary inline-flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection

@push('scripts')
{{-- ✅ Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($usaha->latitude && $usaha->longitude)
        const lat = {{ $usaha->latitude }};
        const lng = {{ $usaha->longitude }};
        
        const map = L.map('map').setView([lat, lng], 15);

        // 🗺️ Tambahkan peta dasar (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // 📍 Tambahkan marker lokasi UMKM
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("<strong>{{ $usaha->nama_usaha }}</strong><br>{{ $usaha->alamat_usaha }}")
            .openPopup();
    @endif
});
</script>
@endpush
