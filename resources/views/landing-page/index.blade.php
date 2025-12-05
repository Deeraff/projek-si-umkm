@extends('layouts.app')

@section('title', 'Landing Page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
<div class="landing-container">
{{-- ===== BANNER CAROUSEL ===== --}}
<div class="banner-carousel-wrapper">
    <div class="banner-carousel" id="bannerCarousel">

        {{-- Banner 1 --}}
        <div class="banner-slide active">
            <img src="{{ asset('storage/banner1.png') }}" alt="Temukan UMKM Favoritmu Sekarang">
        </div>
        <div class="banner-slide">
            <img src="{{ asset('storage/banner2.png') }}" alt="Dukung Produk Lokal Berkualitas">
        </div>
        <div class="banner-slide">
            <img src="{{ asset('storage/banner3.png') }}" alt="Bangun dan Kembangkan UMKM Anda">
        </div>
                <div class="banner-slide">
            <img src="{{ asset('storage/banner4.png') }}" alt="Bangun dan Kembangkan UMKM Anda">
        </div>
    </div>

    <button class="banner-nav prev" id="bannerPrev">❮</button>
    <button class="banner-nav next" id="bannerNext">❯</button>

    <div class="banner-dots" id="bannerDots"></div>
</div>

    {{-- ===== SEARCH + FILTER ===== --}}
    <div class="container mb-4">
        <div id="search-override-container">
            <form action="{{ url('/') }}" method="GET" style="width: 100%;">

                <div class="custom-search-bar">

                    {{-- 1. INPUT SEARCH --}}
                    <div class="search-input-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#6c757d" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari UMKM, Oleh-Oleh, Kuliner, atau Produk Lokal Terbaik...">
                    </div>

                    {{-- 2. DROPDOWN --}}
                    <div class="search-filter-box">
                        <select name="filter" class="form-select custom-select-style">
                            <option value="">Semua Kategori UMKM</option>
                            <option value="terpopuler" {{ request('filter') == 'terpopuler' ? 'selected' : '' }}>Paling Banyak Dikunjungi</option>
                            <option value="24jam" {{ request('filter') == '24jam' ? 'selected' : '' }}>Buka 24 Jam</option>
                            <option value="khas" {{ request('filter') == 'khas' ? 'selected' : '' }}>Produk Khas Daerah</option>
                        </select>
                    </div>

                    {{-- 3. BUTTON --}}
                    <div class="search-btn-box">
                        <button type="submit" class="custom-btn-style">TEMUKAN SEKARANG</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    {{-- ===== ACTION BUTTONS ===== --}}
    <div class="action-buttons-container">

        {{-- PETUNJUK --}}
        <a href="{{ route('landing.petunjuk') }}" class="action-button action-button-blue">
            <div class="button-content">
                <span class="button-text">PANDUAN PENGGUNAAN</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                    <path d="M1 2.828c.882-.44 2.224-.438 3.3.02L6.157 5.5H8V2.828c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L7.157 7.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488l2.36 1.34c.882.44 2.224.438 3.3.02L9.843 14.5H8v-2.672c.882-.44 2.224-.438 3.3.02l2.36 1.34c1.171.66 1.171 2.828 0 3.488l-2.36 1.34c-1.076.61-2.296.61-3.372 0L5.843 14.5H4.828l-2.36 1.34c-1.171.66-1.171 2.828 0 3.488L4.828 14.5H1.672L.5 15.157V2.828z"/>
                </svg>
            </div>
            <div class="button-shine"></div>
        </a>

        {{-- DAFTAR / LIHAT UMKM --}}
        @auth
            @if($hasUmkm)
                <a href="{{ route('umkm.dashboard', $umkmId) }}" class="action-button action-button-green">
                    <div class="button-content">
                        <span class="button-text">KELOLA UMKM ANDA</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="button-icon" viewBox="0 0 16 16">
                            <path d="M6.5 0a.5.5 0 0 1 .5.5V2h2V.5a.5.5 0 0 1 1 0V2h.5A2.5 2.5 0 0 1 13 4.5V6H3V4.5A2.5 2.5 0 0 1 5.5 2H6V.5a.5.5 0 0 1 .5-.5zM3 7h10v5.5A2.5 2.5 0 0 1 10.5 15h-5A2.5 2.5 0 0 1 3 12.5V7z"/>
                        </svg>
                    </div>
                    <div class="button-shine"></div>
                </a>
            @else
                <a href="{{ route('umkm.store') }}" class="action-button action-button-green">
                    <div class="button-content">
                        <span class="button-text">DAFTAR UMKM SEKARANG</span>
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
                    <span class="button-text">GABUNG & DAFTARKAN UMKM</span>
                </div>
                <div class="button-shine"></div>
            </a>
        @endauth

    </div>


    {{-- ===== CAROUSEL UMKM ===== --}}
    <section>
        <h2 class="section-title-gradient">UMKM Inspiratif Pilihan Pengunjung</h2>

        @if($daftarUmkm->count())
            <div class="umkm-carousel-wrapper">

                <button class="carousel-nav-btn prev" id="prevBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </button>

                <div class="umkm-carousel-container" id="umkmCarousel">
                    @foreach($daftarUmkm as $umkm)
                        <div class="umkm-carousel-item">
                            <div class="umkm-card">

                                <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : asset('images/default-logo.png') }}"
                                     alt="{{ $umkm->nama_usaha }}"
                                     class="umkm-card-image">

                                <h3 class="umkm-card-title">{{ $umkm->nama_usaha }}</h3>

                                <div class="umkm-card-info">
                                    <span class="umkm-card-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#16a34a" viewBox="0 0 16 16">
                                            <path d="M8 0a5.5 5.5 0 0 0-5.5 5.5c0 3.04 5.5 10.5 5.5 10.5s5.5-7.46 5.5-10.5A5.5 5.5 0 0 0 8 0zM8 7.5A2 2 0 1 1 8 3.5a2 2 0 0 1 0 4z"/>
                                        </svg>
                                    </span>
                                    <span class="umkm-card-info-text">Lokasi: {{ Str::limit($umkm->alamat_usaha, 50) }}</span>
                                </div>

                                <div class="umkm-card-info">
                                    <span class="umkm-card-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#16a34a" viewBox="0 0 16 16">
                                            <path d="M3.654 1.328a.678.678 0 0 1 .738-.058l2.522 1.261c.329.164.445.565.26.883L6.145 5.6a.678.678 0 0 0 .092.765l1.975 2.316a.678.678 0 0 0 .77.164l1.905-.953a.678.678 0 0 1 .883.26l1.26 2.521a.678.678 0 0 1-.058.738l-1.034 1.292c-.291.364-.78.523-1.234.39a12.035 12.035 0 0 1-6.148-3.84A12.036 12.036 0 0 1 1.686 2.56a1.233 1.233 0 0 1 .39-1.234L3.654 1.328z"/>
                                        </svg>
                                    </span>
                                    <span class="umkm-card-info-text">Hubungi: {{ $umkm->no_telp_usaha ?? 'Kontak belum tersedia' }}</span>
                                </div>

                                <a href="{{ route('umkm.show', $umkm->id) }}" class="umkm-card-link">
                                    Jelajahi Profil UMKM →
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-nav-btn next" id="nextBtn">
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
                    const scrollAmount = 320;

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

                    updateButtonStates();
                });
                
                document.addEventListener("DOMContentLoaded", () => {
                    const carousel = document.getElementById("bannerCarousel");
                    const slides = carousel.querySelectorAll(".banner-slide");
                    const prev = document.getElementById("bannerPrev");
                    const next = document.getElementById("bannerNext");
                    const dotsContainer = document.getElementById("bannerDots");

                    let index = 0;

                    slides.forEach((_, i) => {
                        const dot = document.createElement("div");
                        dot.classList.add("banner-dot");
                        if (i === 0) dot.classList.add("active");
                        dot.addEventListener("click", () => goTo(i));
                        dotsContainer.appendChild(dot);
                    });

                    const dots = dotsContainer.querySelectorAll(".banner-dot");

                    function goTo(i) {
                        slides[index].classList.remove("active");
                        dots[index].classList.remove("active");

                        index = i;

                        slides[index].classList.add("active");
                        dots[index].classList.add("active");
                    }

                    prev.addEventListener("click", () => {
                        let newIndex = index - 1;
                        if (newIndex < 0) newIndex = slides.length - 1;
                        goTo(newIndex);
                    });

                    next.addEventListener("click", () => {
                        let newIndex = (index + 1) % slides.length;
                        goTo(newIndex);
                    });

                    setInterval(() => {
                        goTo((index + 1) % slides.length);
                    }, 4500);
                });
            </script>

        @else
            <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                Belum ada UMKM yang bergabung. Jadilah pelopor usaha lokal di platform ini!
            </div>
        @endif

    </section>


    {{-- ===== VIDEO + PENGUMUMAN + FAQ ===== --}}
    <div class="content-grid">

        <div class="left-column">

            {{-- VIDEO --}}
            <div class="content-card video-card">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor">
                        <path d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.933 1.325l.813 2.169A1 1 0 0 0 12 7.5v1A1 1 0 0 0 10.246 9.5l-.813 2.169A2 2 0 0 1 8.5 13H2a2 2 0 0 1-2-2z"/>
                    </svg>
                    VIDEO INSPIRATIF UMKM
                </h3>
                <div class="video-grid">
                    <div class="video-placeholder"><i class="bi bi-play-circle"></i></div>
                    <div class="video-placeholder"><i class="bi bi-play-circle"></i></div>
                </div>
            </div>

            {{-- PENGUMUMAN --}}
            <div class="content-card announcement-card">
                <h3 class="card-title">INFORMASI & PENGUMUMAN PENTING</h3>

                @if($announcements->count())
                    <ul class="announcement-list">
                        @foreach($announcements as $item)
                            <li class="announcement-item">
                                <p class="announcement-title">{{ $item->judul }}</p>
                                <p class="announcement-text">{{ Str::limit($item->isi, 100) }}</p>
                                <small class="announcement-date">{{ $item->tanggal ? $item->tanggal->format('d M Y') : 'Tanggal tidak tersedia' }}</small>
                            </li>
                        @endforeach

                        <li class="see-more-container">
                            <a href="{{ route('announcements.index') }}" class="see-more-link">Lihat semua pengumuman →</a>
                        </li>
                    </ul>
                @else
                    <p class="empty-message">Belum ada informasi yang dipublikasikan.</p>
                @endif

            </div>
        </div>

        {{-- FAQ --}}
        <div class="content-card faq-card">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14z"/>
                </svg>
                PERTANYAAN YANG SERING DITANYAKAN
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

                <a href="{{ route('faqs.index') }}" class="see-more-link faq-see-more">Lihat semua FAQ →</a>
            @else
                <p class="empty-message">Belum tersedia pertanyaan umum.</p>
            @endif

        </div>
    </div>

</div>
@endsection
