@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('kategori_active', 'active')

@section('content')
<div class="container py-4">
    <h3 class="fw-bolder text-gray-800 mb-4">
        <i class="fas fa-edit me-2 text-success"></i> Edit Kategori Jenis Usaha
    </h3>
    
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0 fw-bold">Mengubah Data Kategori: {{ $kategori->nama_jenis }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_jenis" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="nama_jenis" id="nama_jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        value="{{ old('nama_jenis', $kategori->nama_jenis) }}" required>
                    @error('nama_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Jelaskan secara singkat jenis usaha yang termasuk dalam kategori ini...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Pastikan deskripsi sudah diperbarui dengan benar.</small>
                </div>
                
                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Batal / Kembali
                    </a>
                    <button type="submit" class="btn btn-success shadow-sm px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection