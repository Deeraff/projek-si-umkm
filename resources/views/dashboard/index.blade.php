@extends('layouts.app')

@section('title', 'Dashboard UMKM')

@section('content')
<div>
    {{-- Banner Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-8" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner rounded-lg shadow-md">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x350?text=Banner+1" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x350?text=Banner+2" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x350?text=Banner+3" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- UMKM Section --}}
    <h2 class="section-title mb-6">Dashboard UMKM</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($umkm as $item)
            <div class="card-umkm shadow-md p-6 text-center bg-white rounded-lg">
                {{-- Logo UMKM --}}
                @if($item->logo)
                    <img src="{{ asset('storage/'.$item->logo) }}" alt="Logo" class="w-24 h-24 object-cover mb-3 mx-auto">
                @else
                    <img src="https://via.placeholder.com/100" alt="Logo" class="w-24 h-24 object-cover mb-3 mx-auto">
                @endif

                {{-- Nama UMKM --}}
                <h5 class="font-bold text-lg">{{ $item->nama_umkm }}</h5>

                {{-- Jenis Usaha --}}
                <p class="text-gray-700"><strong>Jenis:</strong> {{ $item->profil->jenis_usaha ?? '-' }}</p>

                {{-- Alamat --}}
                <p class="text-gray-500 text-sm">{{ $item->profil->alamat_usaha ?? '-' }}</p>

                {{-- Button --}}
                <a href="{{ route('umkm.show', $item->id) }}" 
                   class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                   Lihat Detail
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
