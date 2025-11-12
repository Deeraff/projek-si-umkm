@extends('layouts.admin')

@section('title', 'UMKM Pendaftar')

@section('umkm_pendaftar_active', 'active')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">UMKM Pendaftar</h1>
    <p class="mb-4 text-muted">Kelola dan verifikasi UMKM yang baru mendaftar di sini sebelum dipublikasikan.</p>

    {{-- 🔍 Form Pencarian & Filter --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.umkm.pendaftar.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari berdasarkan nama usaha...">
                </div>

                <div class="col-md-3">
                    <select name="status_umkm" id="statusFilter" class="form-select">
                        <option value="unverified" {{ request('status_umkm') == 'unverified' ? 'selected' : '' }}>Belum Diverifikasi</option>
                        <option value="verified" {{ request('status_umkm') == 'verified' ? 'selected' : '' }}>Sudah Diverifikasi</option>
                        <option value="ditolak" {{ request('status_umkm') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>

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
        <h6 class="m-0 font-weight-bold text-primary">Data UMKM Pendaftar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
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
                    @forelse ($data_umkm as $umkm)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $umkm->nama_usaha }}</td>
                            <td class="align-middle text-center">
                                <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                                    alt="Logo UMKM" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            </td>
                            <td class="align-middle">{{ $umkm->jenisUsaha->nama_jenis ?? 'Tidak Ada' }}</td>
                            <td class="align-middle">{{ $umkm->pemilik->nama_lengkap ?? 'N/A' }}</td>
                            <td class="align-middle">{{ Str::limit($umkm->alamat_usaha, 40) }}</td>
                            <td class="align-middle">
                                <div class="d-grid gap-1">
                                    {{-- Tombol Lihat Detail --}}
                                    <a href="{{ route('admin.umkm.show', $umkm->id) }}"
                                        class="btn btn-info btn-sm w-100 mb-1">
                                        Lihat Detail
                                    </a>

                                    {{-- Jika belum diverifikasi --}}
                                    @if ($umkm->status_umkm === 'unverified')
                                        {{-- Tombol Verifikasi --}}
                                        <form action="{{ route('admin.umkm.verify', $umkm->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm w-100 mb-1"
                                                onclick="return confirm('Yakin ingin memverifikasi UMKM ini?');">
                                                Setujui
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak dengan Modal --}}
                                        <button type="button" class="btn btn-danger btn-sm w-100"
                                            data-bs-toggle="modal"
                                            data-bs-target="#tolakModal"
                                            data-id="{{ $umkm->id }}"
                                            data-nama="{{ $umkm->nama_usaha }}">
                                            Tolak
                                        </button>
                                    @endif

                                    {{-- Jika sudah diverifikasi, hanya tombol Lihat Detail --}}
                                    @if ($umkm->status_umkm === 'verified')
                                        <span class="badge bg-success w-100 py-2">Terverifikasi</span>
                                    @endif

                                    {{-- Jika ditolak, tampilkan alasan --}}
                                    @if ($umkm->status_umkm === 'ditolak')
                                        <span class="badge bg-danger w-100 py-2">Ditolak</span>
                                        {{-- <button class="btn btn-secondary btn-sm w-100" disabled>
                                            Ditolak
                                        </button>
                                        <small class="text-danger mt-1 d-block">
                                            Alasan: {{ $umkm->alasan_tolak ?? '-' }}
                                        </small> --}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-box-open fa-2x text-gray-300 mb-2"></i>
                                <p class="text-gray-500">Tidak ada data UMKM untuk status ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="tolakForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="tolakModalLabel">Tolak UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="namaUsahaTolak" class="fw-bold text-dark"></p>
                    <div class="mb-3">
                        <label for="alasan_tolak" class="form-label">Alasan Penolakan:</label>
                        <textarea name="alasan_tolak" id="alasan_tolak" rows="3" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script Modal Dinamis --}}
<script>
    const modal = document.getElementById('tolakModal');
    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const umkmId = button.getAttribute('data-id');
        const namaUsaha = button.getAttribute('data-nama');

        const form = document.getElementById('tolakForm');
        const namaUsahaText = document.getElementById('namaUsahaTolak');

        form.action = `/admin/umkm/${umkmId}/tolak`;
        namaUsahaText.textContent = `Nama Usaha: ${namaUsaha}`;
    });
</script>
@endsection
