@extends('layouts.app')

@section('title', 'Detail UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
{{-- ✅ Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@section('content')
<div class="landing-container py-10">

    <h2 class="section-title-gradient text-center mb-10">Detail UMKM</h2>

    <div class="umkm-detail-card max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-10">
            
            {{-- ✅ Logo UMKM --}}
            <div class="flex-shrink-0 w-full md:w-1/3 flex justify-center md:justify-start">
                @if($usaha->logo)
                    <img src="{{ asset('storage/' . $usaha->logo) }}" alt="Logo UMKM"
                        class="w-48 h-48 object-cover rounded-xl border-2 border-green-500 shadow-md">
                @else
                    <div class="w-48 h-48 flex items-center justify-center rounded-xl bg-gray-100 border border-gray-300 text-gray-400">
                        <i class="bi bi-image" style="font-size:2.5rem;"></i>
                    </div>
                @endif
            </div>

            {{-- ✅ Informasi umum --}}
            <div class="flex-1 space-y-2">
                <h3 class="text-3xl font-bold text-green-700 mb-4">{{ $usaha->nama_usaha }}</h3>
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

        {{-- ✅ Produk UMKM --}}
        <div class="mt-10">
            <h4 class="text-2xl font-semibold text-green-700 mb-4 text-center">Produk UMKM</h4>

            @php
                $produkAktif = $usaha->produk->where('status_produk', 'aktif');
            @endphp

            @if($produkAktif->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($produkAktif as $produk)
                        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition">
                            @if($produk->foto_produk)
                                <img src="{{ asset('storage/' . $produk->foto_produk) }}"
                                    alt="{{ $produk->nama_produk }}"
                                    class="w-full h-36 object-cover">
                            @else
                                <div class="w-full h-36 bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="bi bi-box-seam" style="font-size:2rem;"></i>
                                </div>
                            @endif

                            <div class="p-4">
                                <h5 class="text-lg font-bold text-gray-800">{{ $produk->nama_produk }}</h5>
                                <p class="text-green-600 font-semibold mt-1">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 italic">Belum ada produk aktif yang terdaftar.</p>
            @endif
        </div>

        {{-- ✅ Peta --}}
        <div class="mt-10">
            @if($usaha->latitude && $usaha->longitude)
                <div id="map" class="rounded-xl overflow-hidden" style="height: 400px;"></div>
            @else
                <p class="text-gray-500 italic text-center mt-4">Lokasi belum tersedia.</p>
            @endif
        </div>
    </div>

    {{-- Tombol kembali --}}
    <div class="text-center mt-10">
        <a href="{{ url('/') }}" class="btn-secondary inline-flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($usaha->latitude && $usaha->longitude)
        const lat = {{ $usaha->latitude }};
        const lng = {{ $usaha->longitude }};

        const map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("<strong>{{ $usaha->nama_usaha }}</strong><br>{{ $usaha->alamat_usaha }}")
            .openPopup();
    @endif
});
</script>
@endpush
