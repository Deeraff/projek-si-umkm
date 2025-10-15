@extends('layouts.app')

@section('title', 'Daftar UMKM Kuliner Sukorame')

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    
    {{-- ====================================================== --}}
    {{-- TOMBOL KEMBALI YANG DIPERBARUI --}}
    {{-- ====================================================== --}}
    <div class="mb-8">
        <a href="{{ url('/landing-page/informasi') }}" class="inline-flex items-center gap-2 text-green-700 bg-green-50 hover:bg-green-100 transition-all duration-300 px-5 py-2 rounded-full font-semibold shadow-sm hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Kembali ke Halaman Informasi
        </a>
    </div>
    {{-- ====================================================== --}}

    {{-- Judul Halaman --}}
    <h2 class="text-3xl font-bold text-green-700 mb-4 text-center">UMKM Kuliner Unggulan di Sukorame</h2>
    <p class="text-gray-700 mb-8 text-center">
        Temukan berbagai produk kuliner lezat hasil karya warga Kelurahan Sukorame.
    </p>

    {{-- TAMPILAN FORM PENCARIAN --}}
    <div class="mb-10 max-w-xl mx-auto">
        <form action="" method="GET" class="w-full">
            <div class="relative">
                <input 
                    type="text" 
                    name="search"
                    class="w-full px-5 py-3 text-lg border-2 border-gray-200 rounded-full focus:ring-green-500 focus:border-green-500 transition" 
                    placeholder="Cari nama kue, keripik, atau UMKM..."
                >
                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-5 text-gray-500 hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    {{-- Grid untuk menampilkan semua UMKM Kuliner --}}
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
        
        {{-- KARTU 1 --}}
        <a href="#" class="block group">
            <div class="bg-gray-50 rounded-lg shadow overflow-hidden h-full transform group-hover:scale-105 group-hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('storage/umkm1.jpg') }}" alt="Dapur Bunda Lapis Legit" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Dapur Bunda Lapis Legit</h3>
                    <p class="text-gray-600 text-sm line-clamp-2">
                        Kue lapis legit premium dengan resep warisan keluarga, dibuat dari bahan-bahan pilihan terbaik.
                    </p>
                </div>
            </div>
        </a>

        {{-- KARTU 2 --}}
        <a href="#" class="block group">
            <div class="bg-gray-50 rounded-lg shadow overflow-hidden h-full transform group-hover:scale-105 group-hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('storage/keripik-pedas.jpg') }}" alt="Keripik Singkong Mas Gareng" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Keripik Singkong Mas "Gareng"</h3>
                    <p class="text-gray-600 text-sm line-clamp-2">
                        Keripik singkong renyah dengan bumbu balado pedas manis yang bikin ketagihan setiap gigitan.
                    </p>
                </div>
            </div>
        </a>

        {{-- KARTU 3 --}}
        <a href="#" class="block group">
            <div class="bg-gray-50 rounded-lg shadow overflow-hidden h-full transform group-hover:scale-105 group-hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('storage/getuk-pelangi.jpg') }}" alt="Getuk Pelangi Bu Sum" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Getuk Pelangi Bu "Sum"</h3>
                    <p class="text-gray-600 text-sm line-clamp-2">
                        Jajanan tradisional getuk dengan warna-warni menarik, rasa manis dan tekstur yang lembut.
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection