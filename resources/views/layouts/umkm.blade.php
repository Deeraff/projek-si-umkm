<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Custom CSS (gunakan path public, bukan resources) --}}
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-gray-100 font-sans antialiased">
    {{-- Header --}}
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('landing.index') }}">
                <img src="{{ asset('storage/logo.svg') }}" alt="Logo UMKM" class="h-10 w-auto">
            </a>


            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-green-600 font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Register</a>
                @else
                    {{-- Dropdown Profile dan Logout --}}
                    <div class="relative group">
                        {{-- Trigger Dropdown (Nama Pengguna) --}}
                        <button type="button"
                            class="flex items-center space-x-1 text-green-700 font-medium hover:text-green-600 focus:outline-none">
                            <span>Halo, {{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Isi Dropdown --}}
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">

                            {{-- Link Lihat Profile --}}
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Lihat Profile
                            </a>

                            {{-- Form Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Tombol "Kelola UMKM" untuk Pemilik UMKM (dipertahankan di sebelah kiri) --}}
                    @if (Auth::user()->role === 'pemilik UMKM')
                        <a href="{{ route('kelola.umkm') }}"
                            class="flex items-center space-x-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 00-1 1v1h2V3a1 1 0 00-1-1zM4 5a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-3.414l1.293-1.293A1 1 0 0014.293 3.707L13 5H7L5.707 3.707A1 1 0 004.293 3.707L5.707 5H4zm0 2h12v6H4V7zm0 8h12a1 1 0 01-1 1H5a1 1 0 01-1-1zm6-3a1 1 0 100 2h.01a1 1 0 100-2H10z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Kelola UMKM</span>
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- Footer --}}
    <footer class="bg-green-700 text-white mt-10 py-6">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
            <div>
                <h4 class="font-bold">Kelurahan Sukorame</h4>
                <p>Jl. Veteran No.27, Sukorame</p>
            </div>
            <div>
                <h4 class="font-bold">Ikuti di Media Sosial</h4>
                <p>Facebook | Instagram</p>
            </div>
            <div>
                <h4 class="font-bold">Link</h4>
                <p><a href="{{ route('landing.kontak') }}" class="hover:underline">Kontak Kami</a></p>
                <p><a href="#" class="hover:underline">Kebijakan Privasi</a></p>
            </div>
        </div>
    </footer>

    {{-- Tambahkan ini sebelum body ditutup --}}
    @stack('scripts')
</body>
</html>
