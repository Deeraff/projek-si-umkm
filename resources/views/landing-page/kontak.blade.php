@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    {{-- Tambahkan CDN Font Awesome (sudah benar, tapi kita pindahkan ke sini untuk kerapian) --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @endpush

    <div class="bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-green-700 mb-6 text-center">Kontak Kami</h2>

        <p class="text-gray-700 mb-8 text-center">
            Hubungi kami untuk pertanyaan, saran, atau kerjasama terkait program UMKM Kelurahan Sukorame.
        </p>

        {{-- Grid: Info Kontak + Form --}}
        <div class="grid md:grid-cols-2 grid-cols-1 gap-8">
            {{-- Bagian Info Kontak --}}
            <div>
                <h3 class="text-xl font-semibold text-green-700 mb-4">Informasi Kontak</h3>
                <ul class="space-y-3 text-gray-700">
                    <li>
                        <i class="fa-solid fa-location-dot text-green-600 mr-2"></i>
                        <span class="font-medium text-green-700">Alamat:</span><br>
                        Jl. Veteran No.27, Kelurahan Sukorame, Kota Kediri
                    </li>
                    <li>
                        <i class="fa-solid fa-phone text-green-600 mr-2"></i>
                        <span class="font-medium text-green-700">Telepon:</span><br>
                        (0354) 123456
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope text-green-600 mr-2"></i>
                        <span class="font-medium text-green-700">Email:</span><br>
                        umkm.sukorame@gmail.com
                    </li>
                    <li>
                        <i class="fa-solid fa-clock text-green-600 mr-2"></i>
                        <span class="font-medium text-green-700">Jam Layanan:</span><br>
                        Senin - Jumat, 08.00 - 16.00 WIB
                    </li>
                </ul>

                {{-- Media Sosial --}}
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-green-700 mb-3">Media Sosial</h3>
                    <div class="flex gap-5 text-2xl text-green-600">
                        <a href="#" class="hover:text-green-800 transition" title="Facebook">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="#" class="hover:text-green-800 transition" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="hover:text-green-800 transition" title="Twitter">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="#" class="hover:text-green-800 transition" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bagian Form Kontak --}}
            <div>
                <h3 class="text-xl font-semibold text-green-700 mb-4">Kirim Pesan</h3>
                
                {{-- Tampilkan notifikasi sukses/error --}}
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- PERBAIKAN UTAMA DI SINI --}}
                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nama_lengkap" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Masukkan nama Anda" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Masukkan email aktif Anda" value="{{ old('email') }}">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="pesan" class="block text-gray-700 font-medium mb-1">Pesan</label>
                        <textarea id="pesan" name="pesan" rows="4"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Tulis pesan Anda di sini...">{{ old('pesan') }}</textarea>
                        @error('pesan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        {{-- Peta Lokasi --}}
        <div class="mt-12">
            <h3 class="text-xl font-semibold text-green-700 mb-4 text-center">Lokasi Kami</h3>
            <div class="w-full h-64 rounded-lg overflow-hidden shadow-md">
                <iframe class="w-full h-full border-0"
                    src="https://www.google.com/maps?q=-7.811165013913481, 111.99202978072357&hl=es;z=14&output=embed"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
@endsection
