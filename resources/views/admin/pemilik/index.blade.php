@extends('layouts.admin')

@section('title', 'Pemilik UMKM')
@section('pemilik_active', 'active')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800">Daftar Pemilik UMKM</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-custom-blue text-white">
            <h6 class="m-0">Data Pemilik UMKM</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Lengkap</th>
                            <th width="20%">Email</th>
                            <th width="25%">Alamat</th>
                            <th width="15%">No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemilik as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->alamat_domisili }}</td>
                                <td>{{ $p->no_hp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data pemilik UMKM.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
