@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
{{-- Kontainer utama untuk seluruh konten halaman --}}
<div class="bg-white rounded-xl shadow-md p-8">
    
    {{-- Judul Halaman --}}
    <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Informasi UMKM</h2>

    {{-- Sub-judul atau deskripsi singkat --}}
    <p class="text-gray-700 mb-6 text-center">
        Berikut informasi seputar perkembangan dan kegiatan UMKM di Kelurahan Sukorame.
    </p>

    {{-- Grid untuk menampung kartu-kartu informasi --}}
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        
        {{-- Kartu Informasi 1: Dibuat menjadi link --}}
        <a href="{{ route('informasi.kuliner') }}" class="block">
            <div class="bg-green-50 rounded-lg shadow hover:shadow-lg hover:scale-105 transition p-5 h-full">
                <img src="{{ asset('storage/umkm1.jpg') }}" alt="UMKM Kuliner" class="rounded-lg w-full h-40 object-cover mb-4">
                <h3 class="text-lg font-semibold text-green-700 mb-2">UMKM Kuliner Lokal</h3>
                <p class="text-gray-600 text-sm">
                    Produk kuliner khas Sukorame yang sedang naik daun dan berpotensi menembus pasar digital.
                </p>
            </div>
        </a>

        {{-- Kartu Informasi 2: Dibuat menjadi link --}}
        <a href="{{ route('informasi.kerajinan') }}" class="block">
            <div class="bg-green-50 rounded-lg shadow hover:shadow-lg hover:scale-105 transition p-5 h-full">
                <img src="{{ asset('storage/umkm2.jpg') }}" alt="Kerajinan Tangan" class="rounded-lg w-full h-40 object-cover mb-4">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Kerajinan Tangan Inovatif</h3>
                <p class="text-gray-600 text-sm">
                    Produk-produk kreatif hasil karya warga Sukorame yang memanfaatkan bahan ramah lingkungan.
                </p>
            </div>
        </a>

        {{-- Kartu Informasi 3: Dibuat menjadi link --}}
        <a href="{{ route('informasi.pelatihan') }}" class="block">
            <div class="bg-green-50 rounded-lg shadow hover:shadow-lg hover:scale-105 transition p-5 h-full">
                <img src="{{ asset('storage/umkm3.jpg') }}" alt="Pelatihan UMKM" class="rounded-lg w-full h-40 object-cover mb-4">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Pelatihan dan Workshop</h3>
                <p class="text-gray-600 text-sm">
                    Pemerintah kelurahan secara rutin mengadakan pelatihan digital marketing dan manajemen usaha.
                </p>
            </div>
        </a>

    </div>

    {{-- Bagian Tambahan: Dukungan untuk UMKM --}}
    <div class="mt-10 bg-green-100 p-6 rounded-lg">
        <h3 class="text-xl font-semibold text-green-700 mb-3">Dukungan untuk UMKM</h3>
        <p class="text-gray-700 leading-relaxed">
            Kelurahan Sukorame berkomitmen mendukung pelaku UMKM melalui promosi online, pelatihan keterampilan,
            dan akses ke permodalan. Mari bersama memajukan ekonomi kreatif di lingkungan kita!
        </p>
    </div>
</div>
@endsection