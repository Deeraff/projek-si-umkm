@extends('layouts.umkm')

@section('title', 'Kelola Profil')

@section('content')
<div class="landing-container py-10">
    <div class="content-card max-w-3xl mx-auto">
        <h2 class="section-title-gradient text-center mb-6">Kelola Profil</h2>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- NAMA --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                    <input type="text" name="name" 
                        class="form-input w-full border rounded px-3 py-2"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name') 
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email"
                        class="form-input w-full border rounded px-3 py-2"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email') 
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Peran</label>
                    <input type="text" name="role" 
                        class="form-input w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed" 
                        value="{{ $user->role }}" readonly>
                </div>

                {{-- PASSWORD BARU --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">Kata Sandi Baru</label>
                    <input type="password" name="password" 
                        class="form-input w-full border rounded px-3 py-2" 
                        placeholder="Opsional">
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation"
                        class="form-input w-full border rounded px-3 py-2" 
                        placeholder="Ulangi kata sandi">
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ url()->previous() }}" 
                    class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" 
                        class="btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
