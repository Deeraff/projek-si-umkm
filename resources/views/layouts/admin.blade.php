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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- Custom CSS --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>

    <div class="sidebar">
        {{-- Sidebar Content --}}
        <div class="sidebar-header">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <h5>Kelurahan Sukorame</h5>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-menu-item header">Menu Utama</li>

            <li class="sidebar-menu-item @yield('dashboard_active')">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-menu-item @yield('umkm_pendaftar_active')">
                <a href="{{ route('admin.umkm.pendaftar.index') }}">
                    <i class="fas fa-store"></i>
                    <span>UMKM Pendaftar</span>
                </a>
            </li>

            <li class="sidebar-menu-item @yield('kategori_active')">
                <a href="{{ route('admin.kategori.index') }}">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li class="sidebar-menu-item @yield('pemilik_active')">
                <a href="{{ route('admin.pemilik.index') }}">
                    <i class="fas fa-user"></i>
                    <span>Pemilik UMKM</span>
                </a>
            </li>
        </ul>

        {{-- Tombol Logout --}}
        <div class="sidebar-logout text-center mt-3 mb-3">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="margin: 0;">
                @csrf
                <a href="#" onclick="openLogoutModal()" 
                   style="color: var(--text-light); text-decoration: none; display: inline-block; padding: 10px 20px; border-radius: 8px; transition: background-color 0.2s; background-color: #dc3545;">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span>Logout</span>
                </a>
            </form>
        </div>
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
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- Modal Konfirmasi Logout --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title w-100" id="logoutModalLabel">
                        <i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Logout
                    </h5>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari dashboard?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" onclick="submitLogout()">Ya</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openLogoutModal() {
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show();
        }

        function submitLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    @yield('scripts')
</body>

</html>
