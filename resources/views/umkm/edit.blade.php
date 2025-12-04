@extends('layouts.umkm')

@section('title', 'Edit Data UMKM')

@section('content')
<div class="landing-container py-10">
    <div class="content-card max-w-4xl mx-auto">
        <h2 class="section-title-gradient text-center mb-6">Edit Data Usaha</h2>
        
        <form action="{{ route('umkm.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk update data --}}

            {{-- === BAGIAN 1: DATA UTAMA === --}}
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

                {{-- STATUS TEMPAT --}}
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

                {{-- LOGO --}}
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

            {{-- === BAGIAN 2: JADWAL OPERASIONAL === --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-xl font-bold text-green-700 mb-4">Pengaturan Jadwal Operasional</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- JAM BUKA & TUTUP --}}
                    <div class="form-group">
                        <label class="block text-gray-700 font-bold mb-2">Jam Buka</label>
                        <input type="time" name="jam_buka" class="form-input w-full border rounded px-3 py-2"
                            value="{{ old('jam_buka', $usaha->jadwal?->jam_buka) }}">
                    </div>

                    <div class="form-group">
                        <label class="block text-gray-700 font-bold mb-2">Jam Tutup</label>
                        <input type="time" name="jam_tutup" class="form-input w-full border rounded px-3 py-2"
                            value="{{ old('jam_tutup', $usaha->jadwal?->jam_tutup) }}">
                    </div>
                </div>

                {{-- HARI LIBUR (MINGGUAN) --}}
                <div class="form-group mt-4">
                    <label class="block text-gray-700 font-bold mb-2">Libur Rutin Mingguan</label>
                    <div class="flex flex-wrap gap-4 mt-2">
                        @php
                            $liburSaved = explode(', ', $usaha->jadwal?->hari_libur ?? '');
                            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                        @endphp

                        @foreach($hariList as $hari)
                            <label class="inline-flex items-center space-x-2 cursor-pointer bg-gray-50 px-3 py-2 rounded border hover:bg-gray-100 transition">
                                <input type="checkbox" name="hari_libur[]" value="{{ $hari }}"
                                    class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500"
                                    {{ in_array($hari, $liburSaved) ? 'checked' : '' }}>
                                <span class="text-gray-700">{{ $hari }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-1">*Centang hari di mana toko selalu libur setiap minggunya.</p>
                </div>

                {{-- 🔥 TAMBAHAN BARU: LIBUR TANGGAL TERTENTU 🔥 --}}
                <div class="form-group mt-6 p-4 bg-red-50 rounded border border-red-100">
                    <label class="block text-red-700 font-bold mb-2">Libur Sementara (Opsional)</label>
                    <p class="text-sm text-gray-600 mb-3">Gunakan ini jika toko tutup pada rentang tanggal tertentu (misal: Mudik, Renovasi).</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1 font-semibold">Dari Tanggal</label>
                            <input type="date" name="tgl_libur_mulai" class="form-input w-full border rounded px-3 py-2 bg-white"
                                value="{{ old('tgl_libur_mulai', $usaha->jadwal?->tgl_libur_mulai) }}">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1 font-semibold">Sampai Tanggal</label>
                            <input type="date" name="tgl_libur_selesai" class="form-input w-full border rounded px-3 py-2 bg-white"
                                value="{{ old('tgl_libur_selesai', $usaha->jadwal?->tgl_libur_selesai) }}">
                        </div>
                    </div>
                    <p class="text-xs text-red-500 mt-2">*Kosongkan jika tidak ada rencana libur panjang.</p>
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