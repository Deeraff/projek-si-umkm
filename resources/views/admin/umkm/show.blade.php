@extends('layouts.admin')

@section('title', 'Detail UMKM')

@section('umkm_pendaftar_active', 'active')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800">Detail UMKM</h1>
    <p class="mb-4 text-muted">Informasi lengkap tentang UMKM dan data relasinya.</p>

    <div class="card shadow border-left-primary mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $umkm->nama_usaha }}</h6>
            <a href="{{ route('admin.umkm.pendaftar.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Logo UMKM --}}
                <div class="col-md-4 text-center">
                    <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                        alt="Logo UMKM" class="rounded-circle shadow mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="mt-2">{{ $umkm->nama_usaha }}</h5>
                    <p class="text-muted">{{ $umkm->jenisUsaha->nama_jenis ?? 'Kategori tidak tersedia' }}</p>
                </div>

                {{-- Detail Informasi --}}
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Pemilik</th>
                            <td width="70%">: {{ $umkm->pemilik->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email Pemilik</th>
                            <td>: {{ $umkm->pemilik->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Usaha</th>
                            <td>: {{ $umkm->pemilik->alamat_domisili ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>: {{ $umkm->pemilik->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>: {{ $umkm->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($umkm->status_umkm == 'verified')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @elseif ($umkm->status_umkm == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @if (!empty($umkm->alasan_tolak))
                                        <div class="mt-2 small text-danger">
                                            <strong>Alasan:</strong> {{ $umkm->alasan_tolak }}
                                        </div>
                                    @endif
                                @else
                                    <span class="badge bg-warning text-dark">Belum Diverifikasi</span>
                                @endif
                            </td>                            
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            {{-- Data Usaha --}}
            <h5 class="text-primary mt-4 mb-3">Data Usaha</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 75%;">
                    </colgroup>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $umkm->jenisUsaha->nama_jenis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Bentuk Usaha</th>
                        <td>{{ $umkm->bentuk_usaha ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat UMKM</th>
                        <td>{{ $umkm->alamat_usaha ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>No Telp UMKM</th>
                        <td>{{ $umkm->no_telp_usaha ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Tempat</th>
                        <td>{{ $umkm->status_tempat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tenaga Kerja Laki-laki</th>
                        <td>{{ $umkm->tenaga_kerja_l ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tenaga Kerja Perempuan</th>
                        <td>{{ $umkm->tenaga_kerja_p ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Legalitas Usaha --}}
            <h5 class="text-primary mt-4 mb-3">Legalitas Usaha</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 75%;">
                    </colgroup>
                    <tr>
                        <th>Nomor NIB</th>
                        <td>{{ $umkm->legalitasUsaha->nib ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor IUMK</th>
                        <td>{{ $umkm->legalitasUsaha->iumk ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Sertifikat Halal</th>
                        <td>{{ $umkm->legalitasUsaha->sertifikat_halal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Sertifikat Merek</th>
                        <td>{{ $umkm->legalitasUsaha->sertifikat_merek ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
