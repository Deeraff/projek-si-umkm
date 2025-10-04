@extends('layouts.app')

@section('title', 'Petunjuk')

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    <h2 class="text-2xl font-bold text-green-700 mb-6 text-center">Petunjuk Pendaftaran UMKM</h2>

    <p class="text-gray-700 mb-8 text-center">
        Ikuti langkah-langkah berikut untuk mendaftarkan usaha Anda sebagai UMKM di Kelurahan Sukorame.
        Panduan ini disediakan agar proses pendaftaran lebih mudah dan cepat.
    </p>

    {{-- Langkah-langkah Pendaftaran --}}
    <div class="space-y-6">
        <div class="flex items-start gap-4">
            <div class="bg-green-600 text-white font-bold rounded-full h-10 w-10 flex items-center justify-center">1</div>
            <div>
                <h3 class="text-lg font-semibold text-green-700">Buka Halaman Pendaftaran</h3>
                <p class="text-gray-600">
                    Kunjungi halaman <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">Register</a> 
                    pada menu utama. Pastikan Anda menggunakan email aktif untuk proses verifikasi akun.
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="bg-green-600 text-white font-bold rounded-full h-10 w-10 flex items-center justify-center">2</div>
            <div>
                <h3 class="text-lg font-semibold text-green-700">Lengkapi Data Diri dan Usaha</h3>
                <p class="text-gray-600">
                    Isi form pendaftaran dengan data pribadi dan data usaha secara lengkap. 
                    Pastikan nama usaha, bidang usaha, dan alamat sesuai dengan dokumen resmi.
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="bg-green-600 text-white font-bold rounded-full h-10 w-10 flex items-center justify-center">3</div>
            <div>
                <h3 class="text-lg font-semibold text-green-700">Unggah Dokumen Pendukung</h3>
                <p class="text-gray-600">
                    Siapkan dokumen seperti foto usaha, KTP, dan NPWP (jika ada). Unggah file sesuai format 
                    yang diminta untuk mempermudah verifikasi oleh admin kelurahan.
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="bg-green-600 text-white font-bold rounded-full h-10 w-10 flex items-center justify-center">4</div>
            <div>
                <h3 class="text-lg font-semibold text-green-700">Menunggu Verifikasi</h3>
                <p class="text-gray-600">
                    Setelah data dikirim, tim admin akan memeriksa keaslian dan kelengkapan data Anda. 
                    Anda akan menerima notifikasi melalui email setelah verifikasi selesai.
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="bg-green-600 text-white font-bold rounded-full h-10 w-10 flex items-center justify-center">5</div>
            <div>
                <h3 class="text-lg font-semibold text-green-700">Mulai Mengelola Profil UMKM</h3>
                <p class="text-gray-600">
                    Setelah akun Anda aktif, login ke sistem untuk memperbarui profil usaha, menambah produk,
                    dan mempromosikan kegiatan usaha Anda secara online.
                </p>
            </div>
        </div>
    </div>

    {{-- Persyaratan Pendaftaran --}}
    <div class="mt-10 bg-green-50 border-l-4 border-green-600 p-6 rounded-lg">
        <h3 class="text-xl font-semibold text-green-700 mb-3">Syarat Pendaftaran</h3>
        <ul class="list-disc list-inside text-gray-700 leading-relaxed">
            <li>Memiliki usaha aktif yang berdomisili di Kelurahan Sukorame.</li>
            <li>Memiliki KTP dan foto usaha.</li>
            <li>Usaha berskala mikro, kecil, atau menengah.</li>
            <li>Memiliki nomor telepon yang bisa dihubungi.</li>
        </ul>
    </div>

    {{-- Kontak Bantuan --}}
    <div class="mt-10 bg-green-100 p-6 rounded-lg">
        <h3 class="text-xl font-semibold text-green-700 mb-2">Butuh Bantuan?</h3>
        <p class="text-gray-700 mb-3">
            Jika mengalami kesulitan dalam proses pendaftaran, silakan hubungi petugas UMKM Kelurahan Sukorame.
        </p>
        <ul class="text-gray-700">
            <li><strong>Email:</strong> umkm.sukorame@gmail.com</li>
            <li><strong>Telepon:</strong> (0354) 123456</li>
            <li><strong>Alamat:</strong> Kantor Kelurahan Sukorame, Jl. Veteran No.27, Kediri</li>
        </ul>
    </div>
</div>
@endsection
