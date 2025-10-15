@extends('layouts.app')

@section('title', 'Landing Page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container">
    {{-- Banner Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide carousel-custom" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @for ($i = 0; $i < 3; $i++)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></button>
            @endfor
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/banner1.png') }}" 
                     class="d-block w-100" 
                     alt="Banner 1"> 
                <div class="carousel-overlay"></div>
            </div>
        </div>
    </div>

    {{-- Three Action Buttons --}}
    <div class="action-buttons-container">
        {{-- PETUNJUK Button --}}
        <a href="{{ url('/petunjuk') }}" class="action-button action-button-blue">
            <div class="button-content">
                <span class="button-text">PETUNJUK</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                    <path d="M1 2.828c.882-.44 2.224-.438 3.3.02L6.157 5.5H8V2.828c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L7.157 7.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488l2.36 1.34c.882.44 2.224.438 3.3.02L9.843 14.5H8v-2.672c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L5.843 14.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488L4.828 14.5H1.672L.5 15.157V2.828z"/>
                </svg>
            </div>
            <div class="button-shine"></div>
        </a>

        {{-- DAFTARKAN UMKM Button --}}
        <a href="{{ route('umkm.register') }}" class="action-button action-button-green">
            <div class="button-content">
                <span class="button-text">DAFTARKAN UMKM</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                    <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5h1.5a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                </svg>
            </div>
            <div class="button-shine"></div>
        </a>

        {{-- PENGADUAN Button --}}
        <a href="{{ url('/pengaduan') }}" class="action-button action-button-yellow">
            <div class="button-content">
                <span class="button-text">PENGADUAN MASYARAKAT</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                    <path d="M13 2.5a1.5 1.5 0 0 1 1.5 1.5v7A1.5 1.5 0 0 1 13 12.5H6.5c-.347 0-.74-.15-.99-.446l-4-4a1 1 0 0 1 0-1.108l4-4c.25-.296.643-.446.99-.446H13z"/>
                    <path fill-rule="evenodd" d="M14 5a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                </svg>
            </div>
            <div class="button-shine"></div>
        </a>
    </div>

    <div class="divider"></div>

    {{-- VIDEO + ANNOUNCEMENT + FAQ --}}
    <div class="content-grid">

        {{-- Left Column --}}
        <div class="left-column">

            {{-- VIDEO --}}
            <div class="content-card video-card">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="title-icon" viewBox="0 0 16 16">
                        <path d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.933 1.325l.813 2.169A1 1 0 0 0 12 7.5v1A1 1 0 0 0 10.246 9.5l-.813 2.169A2 2 0 0 1 8.5 13H2a2 2 0 0 1-2-2z"/>
                    </svg>
                    VIDEO
                </h3>
                <div class="video-grid">
                    <div class="video-placeholder">
                        <i class="bi bi-play-circle"></i>
                    </div>
                    <div class="video-placeholder">
                        <i class="bi bi-play-circle"></i>
                    </div>
                </div>
            </div>

            {{-- ANNOUNCEMENT --}}
            <div class="content-card announcement-card">
                <h3 class="card-title">PENGUMUMAN</h3>
                @if($announcements->count()) 
                    <ul class="announcement-list">
                        @foreach($announcements as $item) 
                            <li class="announcement-item">
                                <p class="announcement-title">{{ $item->judul }}</p> 
                                <p class="announcement-text">{{ Str::limit($item->isi, 100) }}</p>
                                <small class="announcement-date">{{ $item->tanggal ? $item->tanggal->format('d M Y') : '' }}</small>
                            </li>
                        @endforeach
                        <li class="see-more-container">
                            <a href="{{ route('announcements.index') }}" class="see-more-link"> 
                                SELENGKAPNYA →
                            </a>
                        </li>
                    </ul>
                @else
                    <p class="empty-message">Belum ada pengumuman.</p>
                @endif
            </div>
        </div>

        {{-- FAQ --}}
        <div class="content-card faq-card">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="title-icon" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14z"/>
                    <path d="M5.255 5.786a.237.237 0 0 1-.24.247A1.574 1.574 0 0 0 4.19 7.29a.74.74 0 1 1-1.396-.168A2.578 2.578 0 0 1 6.57 5.006c.386-.182.793-.24 1.256-.24.582 0 1.058.07 1.438.225.267.108.497.27.68.487.214.267.333.606.333 1.04v.328c0 .324-.13.633-.374.924a3.177 3.177 0 0 1-1.28.918c-.463.15-.992.23-1.562.23-1.077 0-1.922-.266-2.522-.79A2.5 2.5 0 0 1 5.255 5.786zM7.847 11.083a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>
                FAQ
            </h3>
            @if($faqs->count())
                <div class="faq-list">
                    @foreach($faqs as $faq)
                        <div class="faq-item">
                            <p class="faq-question">{{ $faq->pertanyaan }}</p>
                            <p class="faq-answer">{{ Str::limit($faq->jawaban, 120) }}</p>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('faqs.index') }}" class="see-more-link faq-see-more">SELENGKAPNYA →</a>
            @else
                <p class="empty-message">Belum ada FAQ.</p>
            @endif
        </div>
    </div>

    {{-- UMKM Section --}}
    <h2 class="section-title">Data UMKM Unggulan</h2>
    @php
        $umkm = [
            (object)[
                'id' => 1,
                'nama_umkm' => 'Toko Kopi Sejahtera',
                'logo' => null,
                'profil' => (object)['jenis_usaha' => 'Kuliner', 'alamat_usaha' => 'Jl. Kenangan No. 1, Kediri']
            ],
            (object)[
                'id' => 2,
                'nama_umkm' => 'Kerajinan Kayu Ajaib',
                'logo' => null,
                'profil' => (object)['jenis_usaha' => 'Kerajinan', 'alamat_usaha' => 'Jl. Mahoni No. 5, Malang']
            ],
            (object)[
                'id' => 3,
                'nama_umkm' => 'Batik Nusantara',
                'logo' => null,
                'profil' => (object)['jenis_usaha' => 'Fashion', 'alamat_usaha' => 'Jl. Sutra No. 10, Surabaya']
            ],
        ];
    @endphp
    <div class="umkm-grid">
        @foreach($umkm as $item)
            <div class="umkm-card">
                <div class="umkm-logo-container">
                    <img src="{{ $item->logo ? asset('storage/'.$item->logo) : 'https://placehold.co/100x100/10B981/FFFFFF?text=UMKM' }}" 
                         alt="Logo {{ $item->nama_umkm }}" 
                         class="umkm-logo">
                </div>
                <h5 class="umkm-name">{{ $item->nama_umkm }}</h5>
                <p class="umkm-type"><span class="label">Jenis Usaha:</span> {{ $item->profil->jenis_usaha }}</p>
                <p class="umkm-address">{{ $item->profil->alamat_usaha }}</p>
                <a href="{{ route('umkm.show', $item->id) }}" class="umkm-detail-btn">
                    Lihat Detail
                    <span class="btn-arrow">→</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection