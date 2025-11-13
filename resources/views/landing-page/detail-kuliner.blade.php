@extends('layouts.app')

@section('title', 'Daftar UMKM Kuliner Sukorame')

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    
    {{-- Tombol Kembali --}}
    <div class="mb-8">
        <a href="{{ route('landing.informasi') }}" 
           class="inline-flex items-center gap-2 text-green-700 bg-green-50 hover:bg-green-100 transition-all duration-300 px-5 py-2 rounded-full font-semibold shadow-sm hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Kembali ke Halaman Informasi
        </a>
    </div>

    <h2 class="text-3xl font-bold text-green-700 mb-4 text-center">
        UMKM Kuliner di Sukorame
    </h2>
    <p class="text-gray-700 mb-8 text-center">
        Temukan berbagai produk kuliner lezat hasil karya warga Kelurahan Sukorame.
    </p>

    {{-- Form Pencarian --}}
    <div class="mb-10 max-w-xl mx-auto">
        <form action="{{ route('informasi.kuliner') }}" method="GET" class="w-full">
            <div class="relative">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
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

    {{-- Carousel UMKM --}}
    <div class="relative">
        {{-- Tombol kiri --}}
        <button id="scrollLeft" 
            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full shadow-md hover:bg-green-700 z-10">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        {{-- Container scroll --}}
        <div id="umkmCarousel" class="flex overflow-x-auto gap-6 scroll-smooth px-12 py-4 hide-scrollbar">
            @forelse ($umkmList as $umkm)
                <div class="min-w-[260px] bg-gray-50 rounded-xl shadow-md overflow-hidden flex-shrink-0 hover:shadow-lg hover:scale-105 transition-all duration-300">
                    <img 
                        src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default.jpg') }}" 
                        alt="{{ $umkm->nama_usaha }}" 
                        class="w-full h-48 object-cover"
                    >
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-green-700">{{ $umkm->nama_usaha }}</h3>
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fa-solid fa-location-dot text-green-500 mr-1"></i> 
                            {{ $umkm->alamat_usaha ?? 'Alamat belum tersedia' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fa-solid fa-phone text-green-500 mr-1"></i> 
                            {{ $umkm->no_telp_usaha ?? '-' }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 w-full">Belum ada data UMKM Kuliner.</p>
            @endforelse
        </div>

        {{-- Tombol kanan --}}
        <button id="scrollRight" 
            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full shadow-md hover:bg-green-700 z-10">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    {{-- CSS sembunyikan scrollbar --}}
    <style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    </style>

    {{-- Script geser kiri-kanan --}}
    <script>
    document.getElementById('scrollLeft').addEventListener('click', () => {
        document.getElementById('umkmCarousel').scrollBy({ left: -300, behavior: 'smooth' });
    });
    document.getElementById('scrollRight').addEventListener('click', () => {
        document.getElementById('umkmCarousel').scrollBy({ left: 300, behavior: 'smooth' });
    });
    </script>
</div>
@endsection
