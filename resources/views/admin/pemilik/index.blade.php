@extends('layouts.admin')

@section('title', 'Pemilik UMKM')
@section('pemilik_active', 'active')

@section('content')
    <div class="container-fluid py-4">

        <h3 class="fw-bolder text-gray-800 mb-4">
            <i class="fas fa-users me-2 text-success"></i> Daftar Pemilik UMKM
        </h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white py-3">
                <h6 class="m-0 fw-bold">Data Pemilik UMKM Terdaftar</h6>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small">
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="25%">Nama Lengkap</th>
                                <th width="20%">Email</th>
                                <th width="25%">Alamat Domisili</th>
                                <th width="15%">No. HP</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pemilik as $p)
                                <tr>
                                    {{-- Penomoran sesuai halaman --}}
                                    <td class="text-center">
                                        {{ $pemilik->firstItem() + $loop->index }}
                                    </td>

                                    <td class="fw-bold">{{ $p->nama_lengkap }}</td>
                                    <td>{{ $p->email }}</td>

                                    <td class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit($p->alamat_domisili, 50) }}
                                    </td>

                                    <td>{{ $p->no_hp }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                        <p class="text-gray-500 mb-0">Belum ada data pemilik UMKM terdaftar.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($pemilik->hasPages())
                <div class="card-footer bg-light border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">

                        {{-- Info jumlah data --}}
                        <div class="text-muted small ms-2">
                            Showing {{ $pemilik->firstItem() }} to {{ $pemilik->lastItem() }} of {{ $pemilik->total() }}
                            results
                        </div>

                        {{-- Pagination di kanan --}}
                        <nav aria-label="Page navigation" class="pagination-wrapper">
                            {{ $pemilik->links('pagination::bootstrap-5') }}
                        </nav>

                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Sedikit CSS agar pagination lebih elegan --}}
    <style>
        .pagination-wrapper .page-link {
            border-radius: 8px !important;
            padding: 8px 14px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: #198754 !important;
            border-color: #198754 !important;
            color: white !important;
            box-shadow: 0 2px 6px rgba(25, 135, 84, 0.4);
        }

        .pagination-wrapper .page-link:hover {
            background-color: #f3f3f3;
        }
        .pagination-wrapper .small.text-muted {
        display: none !important;
        }
    </style>

@endsection
