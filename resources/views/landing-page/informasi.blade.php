@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Informasi UMKM</h2>

    <p class="text-gray-700 mb-6 text-center">
        Berikut informasi seputar perkembangan dan kegiatan UMKM di Kelurahan Sukorame.
    </p>

    {{-- Grid Informasi --}}
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        {{-- Kartu Informasi 1 --}}
        <div class="bg-green-50 rounded-lg shadow hover:shadow-lg transition p-5">
            <img src="{{ asset('images/umkm1.jpg') }}" alt="UMKM Kuliner" class="rounded-lg w-full h-40 object-cover mb-4">
            <h3 class="text-lg font-semibold text-green-700 mb-2">UMKM Kuliner Lokal</h3>
            <p class="text-gray-600 text-sm">
                Produk kuliner khas Sukorame yang sedang naik daun dan berpotensi menembus pasar digital.
            </p>
        </div>

        {{-- Kartu Informasi 2 --}}
        <div class="bg-green-50 rounded-lg shadow hover:shadow-lg transition p-5">
            <img src="{{ asset('images/umkm2.jpg') }}" alt="Kerajinan Tangan" class="rounded-lg w-full h-40 object-cover mb-4">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Kerajinan Tangan Inovatif</h3>
            <p class="text-gray-600 text-sm">
                Produk-produk kreatif hasil karya warga Sukorame yang memanfaatkan bahan ramah lingkungan.
            </p>
        </div>

        {{-- Kartu Informasi 3 --}}
        <div class="bg-green-50 rounded-lg shadow hover:shadow-lg transition p-5">
            <img src="{{ asset('images/umkm3.jpg') }}" alt="Pelatihan UMKM" class="rounded-lg w-full h-40 object-cover mb-4">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Pelatihan dan Workshop</h3>
            <p class="text-gray-600 text-sm">
                Pemerintah kelurahan secara rutin mengadakan pelatihan digital marketing dan manajemen usaha.
            </p>
        </div>
    </div>

    {{-- Bagian Tambahan --}}
    <div class="mt-10 bg-green-100 p-6 rounded-lg">
        <h3 class="text-xl font-semibold text-green-700 mb-3">Dukungan untuk UMKM</h3>
        <p class="text-gray-700 leading-relaxed">
            Kelurahan Sukorame berkomitmen mendukung pelaku UMKM melalui promosi online, pelatihan keterampilan,
            dan akses ke permodalan. Mari bersama memajukan ekonomi kreatif di lingkungan kita!
        </p>
    </div>
</div>
@endsection
