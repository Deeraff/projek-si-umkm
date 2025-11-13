@extends('layouts.app')

@section('title', 'Detail Profil UMKM - ' . ($umkm->nama_usaha ?? ''))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- CONTAINER UTAMA --- */
        .detail-page-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0;
            background: #fff;
            border-radius: 20px; /* Radius lebih tumpul */
            box-shadow: 0 20px 40px rgba(0,0,0,0.08); /* Shadow lebih halus */
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        /* --- HEADER --- */
        .detail-header {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            padding: 3rem;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 2.5rem;
        }

        /* --- FOTO PROFIL --- */
        .logo-upload-container {
            position: relative;
            width: 130px; 
            height: 130px; 
            flex-shrink: 0;
            cursor: pointer;
            border-radius: 50%;
            overflow: hidden; 
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6;
            border: 5px solid #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); /* Shadow foto lebih pop */
        }
        .logo-image {
            width: 100%; height: 100%; object-fit: cover; 
            border-radius: 50%; transition: transform 0.3s;
        }
        /* Efek zoom dikit pas hover foto */
        .logo-upload-container:hover .logo-image { transform: scale(1.05); }

        /* Overlay Ganti Foto */
        .logo-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            color: white; opacity: 0; transition: opacity 0.3s; z-index: 10;
        }
        .logo-upload-container:hover .logo-overlay { opacity: 1; }
        
        /* Style untuk No Logo (Default) */
        .logo-upload-container.no-logo .logo-overlay {
            opacity: 1;
            background: #e5e7eb;
            color: #6b7280;
            border: none;
        }

        /* --- TEXT HEADER --- */
        .header-text { text-align: left; flex: 1; }
        .header-text h1 {
            margin: 0 0 0.5rem 0; font-size: 2.25rem; color: #111827; font-weight: 800; letter-spacing: -0.025em;
        }
        .badge {
            display: inline-block; padding: 0.4rem 1.2rem;
            background-color: #dbeafe; color: #1e40af;
            border-radius: 50px; font-size: 0.875rem; font-weight: 700;
        }

        /* --- KONTEN DETAIL --- */
        .content-padding { padding: 3rem; }
        .grid-info { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
        .info-group { margin-bottom: 1.75rem; }
        .info-label {
            display: block; font-size: 0.75rem; color: #9ca3af;
            font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em;
        }
        .info-value {
            font-size: 1.125rem; color: #1f2937; font-weight: 600;
            border-bottom: 1px solid #f3f4f6; padding-bottom: 0.5rem;
        }
        .section-box {
            background-color: #f9fafb; padding: 2rem;
            border-radius: 16px; border: 1px solid #f3f4f6; margin-top: 1rem;
        }

        /* --- TOMBOL KEMBALI (YANG BARU) --- */
        .btn-back-container {
            text-align: center;
            margin-top: 3rem;
            border-top: 1px solid #f3f4f6;
            padding-top: 2rem;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem; /* Jarak ikon dan teks */
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); /* Gradasi Biru */
            color: white;
            border-radius: 50px; /* Bentuk Kapsul/Lonjong */
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 10px 20px -10px rgba(37, 99, 235, 0.5); /* Bayangan biru halus */
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-back:hover {
            transform: translateY(-3px); /* Tombol naik sedikit saat hover */
            box-shadow: 0 15px 30px -10px rgba(37, 99, 235, 0.6);
            color: white;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .btn-back:active {
            transform: translateY(-1px);
        }
        
        .btn-back i {
            transition: transform 0.3s;
        }
        .btn-back:hover i {
            transform: translateX(-4px); /* Ikon panah bergerak ke kiri saat hover */
        }

        /* Responsif */
        @media(max-width: 768px) {
            .detail-header { flex-direction: column; text-align: center; padding: 2rem; }
            .header-text { text-align: center; }
            .grid-info { grid-template-columns: 1fr; gap: 1.5rem; }
            .content-padding { padding: 1.5rem; }
        }
    </style>
@endpush

@section('content')
<div class="detail-page-container">
    
    {{-- HEADER --}}
    <div class="detail-header">
        <form id="form-ganti-logo" action="{{ route('umkm.update.logo', $umkm->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <label for="input-logo" 
                   class="logo-upload-container {{ $umkm->logo ? '' : 'no-logo' }}" 
                   title="Klik untuk mengganti foto">
                
                @if($umkm->logo)
                    <img src="{{ asset('storage/' . $umkm->logo) }}" class="logo-image" alt="Logo">
                @endif

                {{-- Overlay / Placeholder --}}
                <div class="logo-overlay">
                    <i class="fas fa-camera" style="font-size: 1.8rem; margin-bottom: 8px;"></i>
                    <span style="font-size: 0.75rem; font-weight: 600;">GANTI FOTO</span>
                </div>
            </label>
            <input type="file" id="input-logo" name="logo" accept="image/*" style="display: none;" onchange="document.getElementById('form-ganti-logo').submit();">
        </form>

        <div class="header-text">
            <h1>{{ $umkm->nama_usaha }}</h1>
            <div class="badge">{{ $umkm->jenisUsaha->nama_kategori ?? 'Kategori Umum' }}</div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div style="background: #ecfdf5; color: #065f46; padding: 1rem; margin: 0 3rem; border-radius: 12px; margin-top: 1.5rem; border: 1px solid #a7f3d0;">
            <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background: #fef2f2; color: #991b1b; padding: 1rem; margin: 0 3rem; border-radius: 12px; margin-top: 1.5rem; border: 1px solid #fecaca;">
            <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i> {{ $errors->first() }}
        </div>
    @endif

    {{-- KONTEN --}}
    <div class="content-padding">
        <div class="grid-info">
            <div>
                <div class="info-group"><span class="info-label">Bentuk Usaha</span><div class="info-value">{{ $umkm->bentuk_usaha }}</div></div>
                <div class="info-group"><span class="info-label">Pemilik</span><div class="info-value">{{ $umkm->pemilik->nama_lengkap ?? '-' }}</div></div>
                <div class="info-group"><span class="info-label">Alamat</span><div class="info-value">{{ $umkm->alamat_usaha }}</div></div>
                <div class="info-group"><span class="info-label">Kontak</span><div class="info-value">{{ $umkm->no_telp_usaha }}</div></div>
            </div>
            <div>
                <div class="info-group"><span class="info-label">Status Tempat</span><div class="info-value" style="text-transform: capitalize;">{{ $umkm->status_tempat }}</div></div>
                <div class="info-group"><span class="info-label">Jumlah Tenaga Kerja</span><div class="info-value">Laki-laki: {{ $umkm->tenaga_kerja_l }} &nbsp;|&nbsp; Perempuan: {{ $umkm->tenaga_kerja_p }}</div></div>
                <div class="section-box">
                    <h3 style="margin-top:0; font-size:1.1rem; margin-bottom:1rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.75rem; color:#111827; font-weight:700;">Dokumen Legalitas</h3>
                    <div class="info-group" style="margin-bottom:0.75rem;"><span class="info-label">NIB</span><div style="font-size:1rem;">{{ $umkm->legalitasUsaha->nib ?? 'Tidak ada' }}</div></div>
                    <div class="info-group" style="margin-bottom:0.5rem;"><span class="info-label">Sertifikat Halal</span><div style="font-size:1rem;">{{ $umkm->legalitasUsaha->sertifikat_halal ?? 'Tidak ada' }}</div></div>
                </div>
            </div>
        </div>

        {{-- TOMBOL KEMBALI (PERBAIKAN) --}}
        <div class="btn-back-container">
            {{-- Mengarah ke 'umkm.dashboard' (yang membuka dashboard_umkm.blade.php) --}}
            <a href="{{ route('umkm.dashboard', ['id' => $umkm->id]) }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> 
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection