@extends('layouts.admin')

@section('title', 'Kategori Jenis Usaha')

@section('kategori_active', 'active')

@section('content')
    <h1 class="mb-4">Daftar Kategori Jenis Usaha</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-custom-blue text-white d-flex justify-content-between align-items-center">
            Data Kategori
            {{-- Tombol Tambah Kategori (Asumsi route add/create) --}}
            <a href="#" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Nama Kategori</th>
                            <th style="width: 50%;">Deskripsi</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_kategori as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->deskripsi_kategori }}</td>
                                <td>
                                    {{-- Tombol Edit (Asumsi route edit) --}}
                                    <a href="#" class="btn btn-warning btn-sm me-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    {{-- Tombol Hapus (Asumsi route delete) --}}
                                    <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data kategori jenis usaha.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
