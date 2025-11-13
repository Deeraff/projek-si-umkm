@extends('layouts.admin')

@section('title', 'Kelola Kategori Usaha')

@section('kategori_active', 'active')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bolder text-gray-800">
            <i class="fas fa-tags me-2 text-success"></i> Daftar Kategori Jenis Usaha
        </h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-success shadow-sm px-4">
            <i class="fas fa-plus me-1"></i> Tambah Kategori Baru
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white py-3">
            <h6 class="mb-0 fw-bold">Data Kategori Usaha</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center text-uppercase small">
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Nama Kategori</th>
                            <th style="width: 50%;">Deskripsi</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_kategori as $index => $kategori)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary text-light fw-bold p-2">
                                        {{ $kategori->nama_jenis }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($kategori->deskripsi, 80) ?? 'Tidak ada deskripsi.' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" 
                                        class="btn btn-warning btn-sm me-2 shadow-sm" 
                                        data-bs-toggle="tooltip" title="Edit Kategori">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_jenis }}? Tindakan ini tidak dapat dibatalkan!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="tooltip" title="Hapus Kategori">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-light mb-3"></i>
                                    <p class="text-gray-500">Saat ini belum ada kategori jenis usaha yang terdaftar.</p>
                                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-outline-success mt-2">Buat Kategori Pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Jika Anda menggunakan pagination, uncomment kode di bawah --}}
        {{-- 
        @if ($data_kategori->hasPages())
            <div class="card-footer bg-light border-top">
                {{ $data_kategori->links('pagination::bootstrap-5') }}
            </div>
        @endif
        --}}
    </div>
    </div>

{{-- Tambahkan script untuk mengaktifkan Tooltip Bootstrap (jika layout admin Anda belum memilikinya) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection