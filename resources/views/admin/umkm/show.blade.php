@extends('layouts.admin')

@section('title', 'Detail UMKM')

@section('umkm_pendaftar_active', 'active')

@section('content')
<div class="container-fluid py-4">

    <h3 class="fw-bolder text-gray-800 mb-2">
        <i class="fas fa-search me-2 text-success"></i> Detail UMKM Pendaftar
    </h3>
    <p class="mb-4 text-muted">Informasi lengkap UMKM **{{ $umkm->nama_usaha }}** dan data relasinya.</p>

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold">Data Utama UMKM</h6>
            <a href="{{ route('admin.umkm.pendaftar.index') }}" class="btn btn-sm btn-light text-dark shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Kiri: Logo UMKM & Status --}}
                <div class="col-md-4 text-center border-end">
                    <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                        alt="Logo UMKM" class="rounded-circle shadow-lg mb-3"
                        style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #198754;">
                    <h4 class="mt-2 fw-bold text-dark">{{ $umkm->nama_usaha }}</h4>
                    <p class="text-muted mb-3">{{ $umkm->jenisUsaha->nama_jenis ?? 'Kategori tidak tersedia' }}</p>

                    <h6 class="fw-bold mt-3">Status Verifikasi:</h6>
                    @if ($umkm->status_umkm == 'verified')
                        <span class="badge bg-success p-2 fs-6"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                    @elseif ($umkm->status_umkm == 'ditolak')
                        <span class="badge bg-danger p-2 fs-6"><i class="fas fa-times-circle"></i> Ditolak</span>
                        @if (!empty($umkm->alasan_tolak))
                            <div class="mt-2 text-danger text-start px-4">
                                <strong>Alasan Penolakan:</strong> {{ $umkm->alasan_tolak }}
                            </div>
                        @endif
                    @else
                        <span class="badge bg-warning text-dark p-2 fs-6"><i class="fas fa-hourglass-half"></i> Belum
                            Diverifikasi</span>
                    @endif
                </div>

                {{-- Kanan: Detail Informasi Pemilik --}}
                <div class="col-md-8">
                    <h5 class="text-success mb-3 fw-bold">Detail Kontak Pemilik</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th width="30%">Nama Pemilik</th>
                                <td width="70%">: {{ $umkm->pemilik->nama_lengkap ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email Pemilik</th>
                                <td>: {{ $umkm->pemilik->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Domisili</th>
                                <td>: {{ $umkm->pemilik->alamat_domisili ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>: {{ $umkm->pemilik->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Daftar UMKM</th>
                                <td>: {{ $umkm->created_at->format('d M Y H:i') }} WIB</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Data Usaha --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-light py-3">
                    <h6 class="m-0 fw-bold text-success">Data Operasional Usaha</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            {{-- Penyesuaian: Memastikan semua TD/TH memiliki ukuran teks standar --}}
                            <tr class="py-2">
                                <th style="width: 45%;" class="bg-gray-100 py-3 ps-3">Kategori</th>
                                <td class="py-3">{{ $umkm->jenisUsaha->nama_jenis ?? '-' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Bentuk Usaha</th>
                                <td class="py-3">{{ $umkm->bentuk_usaha ?? '-' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Alamat UMKM</th>
                                <td class="py-3">{{ $umkm->alamat_usaha ?? '-' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">No Telp UMKM</th>
                                <td class="py-3">{{ $umkm->no_telp_usaha ?? '-' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Status Tempat</th>
                                <td class="py-3">{{ $umkm->status_tempat ?? '-' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Tenaga Kerja Laki-laki</th>
                                <td class="py-3">{{ $umkm->tenaga_kerja_l ?? 0 }} Orang</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Tenaga Kerja Perempuan</th>
                                <td class="py-3">{{ $umkm->tenaga_kerja_p ?? 0 }} Orang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Legalitas Usaha --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-light py-3">
                    <h6 class="m-0 fw-bold text-success">Legalitas Usaha</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            {{-- Penyesuaian: Memastikan semua TD/TH memiliki ukuran teks standar --}}
                            <tr class="py-2">
                                <th style="width: 45%;" class="bg-gray-100 py-3 ps-3">Nomor NIB</th>
                                <td class="py-3">{{ $umkm->legalitasUsaha->nib ?? 'Belum ada NIB' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Nomor IUMK</th>
                                <td class="py-3">{{ $umkm->legalitasUsaha->iumk ?? 'Belum ada IUMK' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Nomor Sertifikat Halal</th>
                                <td class="py-3">
                                    {{ $umkm->legalitasUsaha->sertifikat_halal ?? 'Belum ada Sertifikat Halal' }}</td>
                            </tr>
                            <tr class="py-2">
                                <th class="bg-gray-100 py-3 ps-3">Nomor Sertifikat Merek</th>
                                <td class="py-3">
                                    {{ $umkm->legalitasUsaha->sertifikat_merek ?? 'Belum ada Sertifikat Merek' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection