@extends('layouts.app')

@section('title', 'Landing Page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container">
    {{-- ===== BANNER CAROUSEL ===== --}}
    <div id="carouselExampleIndicators" class="carousel slide carousel-custom" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @for ($i = 0; $i < 3; $i++)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" 
                        class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}">
                </button>
            @endfor
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/banner1.png') }}" alt="Banner 1" class="d-block w-100"> 
                <div class="carousel-overlay"></div>
            </div>
        </div>
    </div>
    {{-- ===== ACTION BUTTONS ===== --}}
    <div class="action-buttons-container">
        {{-- Button Petunjuk --}}
        <a href="{{ url('/petunjuk') }}" class="action-button action-button-blue">
            <div class="button-content">
                <span class="button-text">PETUNJUK</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                    <path d="M1 2.828c.882-.44 2.224-.438 3.3.02L6.157 5.5H8V2.828c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L7.157 7.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488l2.36 1.34c.882.44 2.224.438 3.3.02L9.843 14.5H8v-2.672c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L5.843 14.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488L4.828 14.5H1.672L.5 15.157V2.828z"/>
                </svg>
            </div>
            <div class="button-shine"></div>
        </a>

        {{-- Button Daftarkan/Lihat UMKM --}}
        @auth
            @if($hasUmkm)
                <a href="{{ route('umkm.dashboard', $umkmId) }}" class="action-button action-button-green">

                    <div class="button-content">
                        <span class="button-text">LIHAT UMKM</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                            <path d="M6.5 0a.5.5 0 0 1 .5.5V2h2V.5a.5.5 0 0 1 1 0V2h.5A2.5 2.5 0 0 1 13 4.5V6H3V4.5A2.5 2.5 0 0 1 5.5 2H6V.5a.5.5 0 0 1 .5-.5zM3 7h10v5.5A2.5 2.5 0 0 1 10.5 15h-5A2.5 2.5 0 0 1 3 12.5V7z"/>
                        </svg>
                    </div>
                    <div class="button-shine"></div>
                </a>
            @else
                <a href="{{ route('umkm.store') }}" class="action-button action-button-green">
                    <div class="button-content">
                        <span class="button-text">DAFTARKAN UMKM</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5h1.5a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"/>
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                        </svg>
                    </div>
                    <div class="button-shine"></div>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="action-button action-button-green">
                <div class="button-content">
                    <span class="button-text">DAFTARKAN UMKM</span>
                </div>
                <div class="button-shine"></div>
            </a>
        @endauth

        {{-- Button Pengaduan Masyarakat --}}
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

    {{-- ===== DATA UMKM UNGGULAN ===== --}}
    <section>
        <h2 class="section-title-gradient">Data UMKM Unggulan</h2>

        @if($daftarUmkm->count())
            <div class="umkm-carousel-wrapper">
                <button class="carousel-nav-btn prev" id="prevBtn" aria-label="Scroll left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </button>

            <div class="umkm-carousel-container" id="umkmCarousel">
                @foreach($daftarUmkm as $umkm)
                    <div class="umkm-carousel-item">
                        <div class="umkm-card">
                            <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                                alt="{{ $umkm->nama_usaha }}" class="umkm-card-image">

                            <h3 class="umkm-card-title">{{ $umkm->nama_usaha }}</h3>

                            {{-- Lokasi --}}
                            <div class="umkm-card-info">
                                <span class="umkm-card-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#16a34a" viewBox="0 0 16 16">
                                        <path d="M8 0a5.5 5.5 0 0 0-5.5 5.5c0 3.04 5.5 10.5 5.5 10.5s5.5-7.46 5.5-10.5A5.5 5.5 0 0 0 8 0zM8 7.5A2 2 0 1 1 8 3.5a2 2 0 0 1 0 4z"/>
                                    </svg>
                                </span>
                                <span class="umkm-card-info-text">{{ Str::limit($umkm->alamat_usaha, 50) }}</span>
                            </div>

                            {{-- Telepon --}}
                            <div class="umkm-card-info">
                                <span class="umkm-card-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#16a34a" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 1 .738-.058l2.522 1.261c.329.164.445.565.26.883L6.145 5.6a.678.678 0 0 0 .092.765l1.975 2.316a.678.678 0 0 0 .77.164l1.905-.953a.678.678 0 0 1 .883.26l1.26 2.521a.678.678 0 0 1-.058.738l-1.034 1.292c-.291.364-.78.523-1.234.39a12.035 12.035 0 0 1-6.148-3.84A12.036 12.036 0 0 1 1.686 2.56a1.233 1.233 0 0 1 .39-1.234L3.654 1.328z"/>
                                    </svg>
                                </span>
                                <span class="umkm-card-info-text">{{ $umkm->no_telp_usaha ?? '-' }}</span>
                            </div>

                            <a href="{{ route('umkm.show', $umkm->id) }}" class="umkm-card-link">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

                        

                <button class="carousel-nav-btn next" id="nextBtn" aria-label="Scroll right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const carousel = document.getElementById('umkmCarousel');
                    const prevBtn = document.getElementById('prevBtn');
                    const nextBtn = document.getElementById('nextBtn');
                    const scrollAmount = 320; // item width (300px) + gap (1.5rem = 20px)

                    function updateButtonStates() {
                        const isAtStart = carousel.scrollLeft <= 0;
                        const isAtEnd = carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 10;
                        
                        prevBtn.disabled = isAtStart;
                        nextBtn.disabled = isAtEnd;
                    }

                    prevBtn.addEventListener('click', () => {
                        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                        setTimeout(updateButtonStates, 300);
                    });

                    nextBtn.addEventListener('click', () => {
                        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                        setTimeout(updateButtonStates, 300);
                    });

                    carousel.addEventListener('scroll', updateButtonStates);
                    
                    // Initial state
                    updateButtonStates();
                });
            </script>
        @else
            <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                Belum ada data UMKM yang terdaftar.
            </div>
        @endif
    </section>


    {{-- ===== DIVIDER ===== --}}
    <div class="divider"></div>

    {{-- ===== VIDEO + PENGUMUMAN + FAQ ===== --}}
    <div class="content-grid">
        {{-- Left Column: Video & Pengumuman --}}
        <div class="left-column">
            {{-- Video Section --}}
            <div class="content-card video-card">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="title-icon" viewBox="0 0 16 16">
                        <path d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.933 1.325l.813 2.169A1 1 0 0 0 12 7.5v1A1 1 0 0 0 10.246 9.5l-.813 2.169A2 2 0 0 1 8.5 13H2a2 2 0 0 1-2-2z"/>
                    </svg>
                    VIDEO
                </h3>
                <div class="video-grid">
                    <div class="video-placeholder" role="button" tabindex="0" aria-label="Video 1">
                        <i class="bi bi-play-circle"></i>
                    </div>
                    <div class="video-placeholder" role="button" tabindex="0" aria-label="Video 2">
                        <i class="bi bi-play-circle"></i>
                    </div>
                </div>
            </div>

            {{-- Pengumuman Section --}}
            <div class="content-card announcement-card">
                <h3 class="card-title">PENGUMUMAN</h3>
                @if($announcements->count())
                    <ul class="announcement-list">
                        @foreach($announcements as $item)
                            <li class="announcement-item">
                                <p class="announcement-title">{{ $item->judul }}</p>
                                <p class="announcement-text">{{ Str::limit($item->isi, 100) }}</p>
                                <small class="announcement-date">
                                    {{ $item->tanggal ? $item->tanggal->format('d M Y') : 'Tanpa tanggal' }}
                                </small>
                            </li>
                        @endforeach
                        <li class="see-more-container">
                            <a href="{{ route('announcements.index') }}" class="see-more-link">SELENGKAPNYA →</a>
                        </li>
                    </ul>
                @else
                    <p class="empty-message">Belum ada pengumuman.</p>
                @endif
            </div>
        </div>

        {{-- FAQ Section --}}
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
</div>
@endsection