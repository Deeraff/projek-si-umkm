<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('resources/layouts/app.css') }}" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-700">APP UMKM</h1>

            {{-- Navigasi Utama --}}
            <nav class="space-x-6 hidden md:flex">
                <a href="{{ route('beranda') }}"
                    class="{{ request()->routeIs('beranda') ? 'text-green-600 font-bold' : 'hover:text-green-600' }}">
                    Beranda
                </a>

                <a href="{{ route('landing.informasi') }}"
                    class="{{ request()->routeIs('landing.informasi') ? 'text-green-600 font-bold' : 'hover:text-green-600' }}">
                    Informasi
                </a>

                <a href="{{ route('landing.petunjuk') }}"
                    class="{{ request()->routeIs('landing.petunjuk') ? 'text-green-600 font-bold' : 'hover:text-green-600' }}">
                    Petunjuk
                </a>

                <a href="{{ route('landing.kontak') }}"
                    class="{{ request()->routeIs('landing.kontak') ? 'text-green-600 font-bold' : 'hover:text-green-600' }}">
                    Kontak
                </a>
            </nav>

            {{-- Link Login/Register atau Nama Pengguna --}}
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-green-600 font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Register</a>
                @else
                    <span class="text-green-700 font-medium">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-green-600 font-medium">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

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
                <p><a href="#" class="hover:underline">Kontak Kami</a></p>
                <p><a href="#" class="hover:underline">Kebijakan Privasi</a></p>
            </div>
        </div>
    </footer>
</body>

</html>
