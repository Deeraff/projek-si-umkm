@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('kategori_active', 'active')

@section('content')
<div class="container py-4">
    <h3 class="fw-bolder text-gray-800 mb-4">
        <i class="fas fa-plus-circle me-2 text-success"></i> Tambah Kategori Jenis Usaha Baru
    </h3>
    
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0 fw-bold">Input Data Kategori</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_jenis" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="nama_jenis" id="nama_jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        value="{{ old('nama_jenis') }}" placeholder="Contoh: Makanan & Minuman, Jasa, dll." required>
                    @error('nama_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Jelaskan secara singkat jenis usaha yang termasuk dalam kategori ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                    <button type="submit" class="btn btn-success shadow-sm px-4">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection