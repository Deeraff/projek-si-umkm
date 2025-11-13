@extends('layouts.umkm')

@section('title', 'Edit Data UMKM')

@section('content')
<div class="landing-container py-10">
    <div class="content-card max-w-4xl mx-auto">
        <h2 class="section-title-gradient text-center mb-6">Edit Data Usaha</h2>
        
        <form action="{{ route('umkm.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk update data --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- NAMA USAHA --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Nama Usaha</label>
                    <input type="text" name="nama_usaha" class="form-input w-full border rounded px-3 py-2" 
                           value="{{ old('nama_usaha', $usaha->nama_usaha) }}" required>
                </div>

                {{-- JENIS USAHA (Dropdown) --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Jenis Usaha</label>
                    <select name="jenis_usaha_id" class="form-input w-full border rounded px-3 py-2" required>
                        @foreach($jenisUsaha as $jenis)
                            <option value="{{ $jenis->id }}" {{ $usaha->jenis_usaha_id == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BENTUK USAHA --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Bentuk Usaha</label>
                    <select name="bentuk_usaha" class="form-input w-full border rounded px-3 py-2" required>
                        <option value="perorangan" {{ $usaha->bentuk_usaha == 'perorangan' ? 'selected' : '' }}>Perorangan</option>
                        <option value="cv" {{ $usaha->bentuk_usaha == 'cv' ? 'selected' : '' }}>CV</option>
                        <option value="pt" {{ $usaha->bentuk_usaha == 'pt' ? 'selected' : '' }}>PT</option>
                        <option value="lainnya" {{ $usaha->bentuk_usaha == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                {{-- ALAMAT USAHA --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Alamat Tempat Usaha</label>
                    <textarea name="alamat_usaha" class="form-input w-full border rounded px-3 py-2" rows="3" required>{{ old('alamat_usaha', $usaha->alamat_usaha) }}</textarea>
                </div>

                {{-- NO TELEPON USAHA --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">No. Telepon Usaha</label>
                    <input type="text" name="no_telp_usaha" class="form-input w-full border rounded px-3 py-2" 
                           value="{{ old('no_telp_usaha', $usaha->no_telp_usaha) }}" required>
                </div>

                {{-- STATUS TEMPAT (Sesuai ENUM database) --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Status Tempat Usaha</label>
                    <select name="status_tempat" class="form-input w-full border rounded px-3 py-2" required>
                        <option value="milik sendiri" {{ $usaha->status_tempat == 'milik sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                        <option value="sewa" {{ $usaha->status_tempat == 'sewa' ? 'selected' : '' }}>Sewa</option>
                        <option value="pinjam" {{ $usaha->status_tempat == 'pinjam' ? 'selected' : '' }}>Pinjam</option>
                    </select>
                </div>

                {{-- TENAGA KERJA --}}
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Tenaga Kerja Laki-laki</label>
                    <input type="number" name="tenaga_kerja_l" class="form-input w-full border rounded px-3 py-2" 
                           value="{{ old('tenaga_kerja_l', $usaha->tenaga_kerja_l) }}">
                </div>
                <div class="form-group">
                    <label class="block text-gray-700 font-bold mb-2">Tenaga Kerja Perempuan</label>
                    <input type="number" name="tenaga_kerja_p" class="form-input w-full border rounded px-3 py-2" 
                           value="{{ old('tenaga_kerja_p', $usaha->tenaga_kerja_p) }}">
                </div>

                {{-- LOGO (Opsional) --}}
                <div class="form-group md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Update Logo (Opsional)</label>
                    @if($usaha->logo)
                        <div class="mb-2">
                            <p class="text-sm text-gray-500">Logo saat ini:</p>
                            <img src="{{ asset('storage/'.$usaha->logo) }}" class="w-20 h-20 object-cover rounded border">
                        </div>
                    @endif
                    <input type="file" name="logo" class="form-input w-full border rounded px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti logo.</p>
                </div>

            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('kelola.umkm') }}" class="btn-secondary bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection