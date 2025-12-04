@extends('layouts.app')

@section('title', 'Detail UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
{{-- ✅ Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@section('content')

{{-- 
    =======================================================
    LOGIKA OTOMATIS CEK HARI & TANGGAL
    =======================================================
--}}
@php
    // 1. Setup Waktu
    \Carbon\Carbon::setLocale('id');
    $now = \Carbon\Carbon::now();
    $tglHariIni = $now->format('Y-m-d'); // Format: 2024-11-30

    // Array Hari Manual (Biar aman bahasa Indonesia)
    $namaHari = [
        0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu',
        4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'
    ];
    $hariIniStr = $namaHari[$now->dayOfWeek]; 

    // 2. Ambil Data Jadwal
    $jamBuka  = $usaha->jadwal->jam_buka ?? '-';
    $jamTutup = $usaha->jadwal->jam_tutup ?? '-';
    $listLiburRutin = $usaha->jadwal->hari_libur ?? ''; // Contoh: "Sabtu, Minggu"
    
    // Ambil Tanggal Libur Sementara
    $tglMulai = $usaha->jadwal->tgl_libur_mulai ?? null;
    $tglSelesai = $usaha->jadwal->tgl_libur_selesai ?? null;

    // 3. Logika Penentuan Status
    $statusToko = 'BUKA';
    $warnaTeks = '#198754'; // Hijau
    $infoLibur = '';

    // A. Cek Libur Tanggal Tertentu (Prioritas Utama)
    $isLiburTanggal = false;
    if ($tglMulai && $tglSelesai) {
        if ($tglHariIni >= $tglMulai && $tglHariIni <= $tglSelesai) {
            $isLiburTanggal = true;
            // Format tanggal cantik (misal: 25 Nov - 30 Nov)
            $mulaiIndo = \Carbon\Carbon::parse($tglMulai)->translatedFormat('d M');
            $selesaiIndo = \Carbon\Carbon::parse($tglSelesai)->translatedFormat('d M');
            $infoLibur = "Tutup Sementara ($mulaiIndo - $selesaiIndo)";
        }
    }

    // B. Cek Libur Rutin (Jika tidak sedang libur tanggal)
    $isLiburRutin = false;
    if (!$isLiburTanggal && !empty($listLiburRutin) && str_contains($listLiburRutin, $hariIniStr)) {
        $isLiburRutin = true;
        $infoLibur = "Libur Rutin: $listLiburRutin";
    }

    // C. Finalisasi Status
    if ($isLiburTanggal || $isLiburRutin) {
        $statusToko = 'TUTUP';
        $warnaTeks = '#dc3545'; // Merah
    }
@endphp

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
            <div class="flex-1 space-y-2 w-full">
                
                {{-- HEADER: NAMA USAHA --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2">
                    <h3 class="text-3xl font-bold text-green-700">{{ $usaha->nama_usaha }}</h3>
                </div>

                {{-- Jam Buka Tutup --}}
                <div class="text-sm text-gray-600 mb-4 flex flex-wrap items-center gap-2">
                    <i class="bi bi-clock-fill text-green-600"></i> 
                    <span class="font-medium">Jam Buka Tutup:</span> 
                    {{ $jamBuka }} - {{ $jamTutup }} WIB
                    
                    {{-- Tampilkan Label Libur jika ada --}}
                    @if($infoLibur)
                        <span class="text-red-600 text-xs bg-red-50 px-2 py-0.5 rounded border border-red-200 font-semibold ml-2">
                            {{ $infoLibur }}
                        </span>
                    @elseif($listLiburRutin)
                         <span class="text-gray-500 text-xs bg-gray-100 px-2 py-0.5 rounded border border-gray-200 ml-2">
                            Libur: {{ $listLiburRutin }}
                        </span>
                    @endif
                </div>

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
                    
                    {{-- Status Hari Ini --}}
                    <div class="umkm-info-item">
                        <strong>Hari Ini ({{ $hariIniStr }})</strong>
                        <span style="font-weight: bold; font-size: 1.2rem; color: {{ $warnaTeks }};">
                            {{ $statusToko }}
                        </span>
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
                            <a href="{{ route('produk.detail', $produk->id) }}" class="block h-full">
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
                            </a>
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