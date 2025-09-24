@extends('layouts.app')

@section('title', $umkm->nama_umkm)

@section('content')
<div class="container py-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        {{-- Logo --}}
        @if($umkm->logo)
            <img src="{{ asset('storage/'.$umkm->logo) }}" alt="Logo" class="w-32 h-32 object-cover mb-4">
        @else
            <img src="https://via.placeholder.com/120" alt="Logo" class="w-32 h-32 object-cover mb-4">
        @endif

        <h2 class="text-2xl font-bold mb-3">{{ $umkm->nama_umkm }}</h2>
        <p><strong>Jenis Usaha:</strong> {{ $umkm->profil->jenis_usaha ?? '-' }}</p>
        <p><strong>Alamat:</strong> {{ $umkm->profil->alamat_usaha ?? '-' }}</p>
    </div>
</div>
@endsection

