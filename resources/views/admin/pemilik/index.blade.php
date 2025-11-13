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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="25%">Nama Lengkap</th>
                            <th width="20%">Email</th>
                            <th width="25%">Alamat Domisili</th>
                            <th width="15%">No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemilik as $index => $p)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $p->nama_lengkap }}</td>
                                <td>{{ $p->email }}</td>
                                <td class="text-muted small">{{ \Illuminate\Support\Str::limit($p->alamat_domisili, 50) }}</td>
                                <td>{{ $p->no_hp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                                    <p class="text-gray-500">Belum ada data pemilik UMKM yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Jika Anda menggunakan pagination, tambahkan footer --}}
        {{-- 
        @if ($pemilik->hasPages())
            <div class="card-footer bg-light border-top">
                {{ $pemilik->links('pagination::bootstrap-5') }}
            </div>
        @endif
        --}}
    </div>
</div>
@endsection