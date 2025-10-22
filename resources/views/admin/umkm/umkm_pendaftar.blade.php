@extends('layouts.admin')

@section('title', 'UMKM Pendaftar')

@section('umkm_pendaftar_active', 'active') {{-- Menandai menu UMKM Pendaftar aktif --}}

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">UMKM Pendaftar</h1>
        <p class="mb-4 text-muted">Kelola dan verifikasi UMKM yang baru mendaftar di sini sebelum dipublikasikan.</p>
        {{-- 🔍 Form Pencarian & Filter --}}
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.umkm.pendaftar.index') }}" method="GET" class="row g-2 align-items-center">
                    {{-- Kolom pencarian --}}
                    <div class="col-md-5">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari berdasarkan nama usaha...">
                    </div>

                    {{-- Dropdown filter --}}
                    <div class="col-md-3">
                        <select name="status_umkm" id="statusFilter" class="form-select">
                            <option value="semua" {{ request('status_umkm') == 'semua' ? 'selected' : '' }}>Semua Status
                            </option>
                            <option value="unverified" {{ request('status_umkm') == 'unverified' ? 'selected' : '' }}>Belum
                                Diverifikasi</option>
                            <option value="verified" {{ request('status_umkm') == 'verified' ? 'selected' : '' }}>Sudah
                                Diverifikasi</option>
                            <option value="rejected" {{ request('status_umkm') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    {{-- Tombol cari --}}
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>

                    {{-- Tombol reset --}}
                    <div class="col-md-2">
                        <a href="{{ route('admin.umkm.pendaftar.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-undo me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Script agar filter langsung submit --}}
        <script>
            document.getElementById('statusFilter').addEventListener('change', function() {
                this.form.submit();
            });
        </script>
    </div>

    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pendaftar (Unverified)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Hapus table-striped agar tampilan lebih bersih --}}
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Profil</th>
                            <th>Kategori</th>
                            <th>Pemilik</th>
                            <th>Alamat Usaha</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Lakukan loop data dari Controller --}}
                        @forelse ($data_umkm as $umkm)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    <strong>{{ $umkm->nama_usaha }}</strong>
                                </td>
                                <td class="align-middle text-center">
                                    {{-- Tampilkan Profil dengan ukuran yang konsisten --}}
                                    <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                                        alt="Logo UMKM"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                                </td>
                                {{-- Asumsi Anda memiliki relasi ke model Kategori --}}
                                <td class="align-middle">{{ $umkm->jenisUsaha->nama_jenis ?? 'Tidak Ada' }}</td>
                                {{-- Asumsi Anda memiliki relasi ke model Pemilik --}}
                                <td class="align-middle">{{ $umkm->pemilik->nama_lengkap ?? 'N/A' }}</td>
                                <td class="align-middle">{{ \Illuminate\Support\Str::limit($umkm->alamat_usaha, 40) }}
                                </td>
                                <td class="align-middle">
                                    {{-- Tombol Aksi disusun vertikal menggunakan d-grid gap-1 (Bootstrap utility) --}}
                                    <div class="d-grid gap-1">
                                        {{-- Tombol Lihat Detail --}}
                                        <a href="{{ route('admin.umkm.show', $umkm->id) }}"
                                            class="btn btn-info btn-sm w-100 mb-1" title="Lihat Detail">
                                            Lihat Detail
                                        </a>

                                        {{-- Tombol Verifikasi/Setujui --}}
                                        <form action="{{ route('admin.umkm.verify', $umkm->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm w-100 mb-1"
                                                title="Verifikasi UMKM"
                                                onclick="return confirm('Apakah Anda yakin ingin memverifikasi UMKM ini?');">
                                                Setujui
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak/Hapus --}}
                                        <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                title="Tolak dan Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data UMKM ini?');">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-box-open fa-2x text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">Tidak ada UMKM yang menunggu verifikasi saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination (jika digunakan) --}}
            <div class="mt-3">
                {{-- Tampilkan link pagination jika $data_umkm menggunakan paginate() --}}
                {{-- {{ $data_umkm->links() }} --}}
            </div>
        </div>
    </div>

    </div>
@endsection
