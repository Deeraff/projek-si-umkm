<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - APP UMKM | @yield('title')</title>

    {{-- Link CSS Eksternal --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    {{-- Custom CSS (Memanggil file yang baru dibuat di atas) --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>

    <div class="sidebar">
        {{-- Sidebar Content --}}
        <div class="sidebar-header">
            {{-- Menggunakan placeholder jika aset logo.png belum tersedia --}}
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <h5>Kelurahan Sukorame</h5>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-menu-item header">Menu Utama</li>
            <li class="sidebar-menu-item @yield('dashboard_active')">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span>UMKM Pendaftar</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="fas fa-tags"></i>
                    <span>Kategori UMKM</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-logout">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="margin: 0;">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    style="color: var(--text-light); text-decoration: none; display: block; padding: 10px; border-radius: 5px; transition: background-color 0.2s;">
                    <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>
                    <span>Logout</span>
                </a>
            </form>
        </div>
        {{-- End Sidebar Content --}}
    </div>

    <div class="main-wrapper">
        <header class="main-header">
            <div class="header-left">
                <i class="fas fa-bars menu-toggle"></i>
                <h4>APP UMKM</h4>
            </div>
            <div class="header-right">
                <div class="admin-info">
                    <i class="fas fa-user-circle"></i>
                    {{-- MENGAMBIL NAMA USER YANG SEDANG LOGIN --}}
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Class main-content memiliki padding-top yang menyesuaikan tinggi header fixed --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts') {{-- Tempat untuk JS tambahan dari halaman spesifik --}}
</body>

</html>
