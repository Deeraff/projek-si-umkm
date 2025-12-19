@extends('layouts.admin')

@section('title', 'UMKM Pendaftar')

@section('umkm_pendaftar_active', 'active')

@section('content')
    <div class="container-fluid py-4">

        <h3 class="fw-bolder text-gray-800 mb-2">
            <i class="fas fa-user-check me-2 text-success"></i> UMKM Pendaftar
        </h3>
        <p class="mb-4 text-muted">Kelola dan verifikasi UMKM yang baru mendaftar di sini sebelum dipublikasikan.</p>

        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('admin.umkm.pendaftar.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm" placeholder="Cari berdasarkan nama usaha...">
                    </div>

                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status_umkm" id="statusFilter" class="form-select form-select-sm">
                            <option value="unverified" {{ request('status_umkm') == 'unverified' ? 'selected' : '' }}>Belum
                                Diverifikasi</option>
                            <option value="verified" {{ request('status_umkm') == 'verified' ? 'selected' : '' }}>Sudah
                                Diverifikasi</option>
                            <option value="ditolak" {{ request('status_umkm') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-2 mb-md-0">
                        <button type="submit" class="btn btn-success btn-sm w-100 shadow-sm">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.umkm.pendaftar.index') }}" class="btn btn-outline-secondary btn-sm w-100">
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

        <div class="card shadow-lg mb-4 border-0">
            <div class="card-header bg-success text-white py-3">
                <h6 class="m-0 fw-bold">Data UMKM Pendaftar</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr class="text-center text-uppercase small">
                                <th style="width: 5%;">No</th>
                                <th>Nama Usaha</th>
                                <th>Profil</th>
                                <th>Kategori</th>
                                <th>Pemilik</th>
                                <th>Alamat Usaha</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_umkm as $umkm)
                                <tr>
                                    {{-- 🎯 Perubahan 1: Gunakan penomoran yang benar untuk pagination --}}
                                    <td class="align-middle text-center">{{ $data_umkm->firstItem() + $loop->index }}</td>
                                    <td class="align-middle fw-bold">{{ $umkm->nama_usaha }}</td>
                                    <td class="align-middle text-center">
                                        <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                                            alt="Logo UMKM"
                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="badge bg-info text-dark">{{ $umkm->jenisUsaha->nama_jenis ?? 'Tidak Ada' }}</span>
                                    </td>
                                    <td class="align-middle">{{ $umkm->pemilik->nama_lengkap ?? 'N/A' }}</td>
                                    <td class="align-middle text-muted small">{{ Str::limit($umkm->alamat_usaha, 40) }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-grid gap-1">
                                            {{-- Tombol Lihat Detail (menggunakan info/biru agar kontras) --}}
                                            <a href="{{ route('admin.umkm.show', $umkm->id) }}"
                                                class="btn btn-info btn-sm w-100 mb-1 shadow-sm">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>

                                            @if ($umkm->status_umkm === 'unverified')
                                                {{-- Tombol Verifikasi (menggunakan HIJAU/btn-success) --}}
                                                <form action="{{ route('admin.umkm.verify', $umkm->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm w-100 mb-1 shadow-sm"
                                                        onclick="return confirm('Yakin ingin memverifikasi UMKM ini?');">
                                                        <i class="fas fa-check-circle me-1"></i> Setujui
                                                    </button>
                                                </form>

                                                {{-- Tombol Tolak (btn-danger) --}}
                                                <button type="button" class="btn btn-danger btn-sm w-100 shadow-sm"
                                                    data-bs-toggle="modal" data-bs-target="#tolakModal"
                                                    data-id="{{ $umkm->id }}" data-nama="{{ $umkm->nama_usaha }}">
                                                    <i class="fas fa-times-circle me-1"></i> Tolak
                                                </button>
                                            @endif

                                            @if ($umkm->status_umkm === 'verified')
                                                <span class="badge bg-success w-100 py-2">Terverifikasi</span>
                                            @endif

                                            @if ($umkm->status_umkm === 'ditolak')
                                                <span class="badge bg-danger w-100 py-2">Ditolak</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-box-open fa-3x text-light mb-3"></i>
                                        <p class="text-gray-500">Tidak ada data UMKM untuk status ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 🎯 Pagination dengan desain --}}
            @if ($data_umkm->hasPages())
                <div class="card-footer bg-light border-top py-3">

                    <div class="d-flex justify-content-between align-items-center w-100">

                        {{-- Info Pagination (Kiri) --}}
                        <div class="text-muted small">
                            Showing {{ $data_umkm->firstItem() }}
                            to {{ $data_umkm->lastItem() }}
                            of {{ $data_umkm->total() }} results
                        </div>

                        {{-- Pagination (Kanan) --}}
                        <div class="pagination-wrapper">

                            <style>
                                .pagination .page-link {
                                    border-radius: 8px !important;
                                    margin: 0 4px;
                                    box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
                                    font-weight: 600;
                                }

                                .pagination .page-item.active .page-link {
                                    background-color: #0d6efd !important;
                                    border-color: #0d6efd !important;
                                    color: #fff !important;
                                    box-shadow: 0 2px 6px rgba(13, 110, 253, .4);
                                }

                                .pagination .page-link:hover {
                                    background-color: #e7f1ff !important;
                                    border-color: #0d6efd !important;
                                }

                                /* Hilangkan text kecil bootstrap "Showing x ..." di sebelah kanan */
                                .pagination-wrapper .small.text-muted,
                                .pagination-wrapper .text-sm.text-muted,
                                .pagination-wrapper .pagination-summary {
                                    display: none !important;
                                }
                            </style>

                            <nav class="d-flex justify-content-end">
                                {{ $data_umkm->links('pagination::bootstrap-5') }}
                            </nav>

                        </div>

                    </div>

                </div>
            @endif

        </div>
    </div>

    {{-- MODAL TOLAK (Tidak ada perubahan yang signifikan di modal, hanya penambahan konteks) --}}
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="tolakForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="tolakModalLabel"><i class="fas fa-exclamation-triangle me-1"></i> Tolak
                            UMKM</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Anda akan menolak pendaftaran dari:</p>
                        <p id="namaUsahaTolak" class="fw-bold fs-5 text-dark"></p>
                        <div class="mb-3">
                            <label for="alasan_tolak" class="form-label fw-bold">Alasan Penolakan:</label>
                            <textarea name="alasan_tolak" id="alasan_tolak" rows="3" class="form-control"
                                placeholder="Jelaskan alasan penolakan secara rinci..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger shadow-sm">Kirim Penolakan</button>
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

            // Pastikan route yang digunakan sama dengan yang digunakan untuk update status_umkm
            form.action = `{{ url('admin/umkm') }}/${umkmId}/tolak`;
            namaUsahaText.textContent = `Nama Usaha: ${namaUsaha}`;
        });
    </script>
@endsection
