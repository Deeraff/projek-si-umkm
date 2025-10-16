@extends('layouts.admin')

@section('title', 'UMKM Pendaftar')

@section('umkm_pendaftar_active', 'active') {{-- Menandai menu UMKM Pendaftar aktif --}}

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Daftar UMKM Pendaftar (Unverified)</h1>
        <p class="text-muted">Kelola dan verifikasi UMKM yang baru mendaftar di sini.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pendaftar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Usaha</th>
                                <th>Kategori</th>
                                <th>Pemilik</th>
                                <th>Alamat Usaha</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Lakukan loop data dari Controller --}}
                            @forelse ($data_umkm as $umkm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $umkm->nama_usaha }}</strong>
                                        <div class="badge bg-danger">Unverified</div>
                                    </td>
                                    {{-- Asumsi Anda memiliki relasi ke model Kategori --}}
                                    <td>{{ $umkm->kategori->nama_kategori ?? 'Tidak Ada' }}</td>
                                    {{-- Asumsi Anda memiliki relasi ke model Pemilik --}}
                                    <td>{{ $umkm->pemilik->nama_pemilik ?? 'N/A' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($umkm->alamat_usaha, 40) }}</td>
                                    <td>{{ $umkm->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.umkm.show', $umkm->id) }}" class="btn btn-info btn-sm mb-1" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Tombol Verifikasi --}}
                                        <form action="{{ route('admin.umkm.verify', $umkm->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH') {{-- Gunakan PATCH/PUT untuk update status --}}
                                            <button type="submit" class="btn btn-success btn-sm mb-1" title="Verifikasi UMKM"
                                                onclick="return confirm('Apakah Anda yakin ingin memverifikasi UMKM ini? Data akan dipindahkan ke UMKM Aktif.');">
                                                <i class="fas fa-check-circle"></i> Verifikasi
                                            </button>
                                        </form>
                                        {{-- Tombol Tolak/Hapus --}}
                                        <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" title="Tolak dan Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data UMKM ini?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada UMKM yang menunggu verifikasi saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Pagination (jika Anda menggunakan paginate() di Controller) --}}
                <div class="mt-3">
                    {{-- {{ $data_umkm->links() }} --}}
                </div>
            </div>
        </div>

    </div>
@endsection
