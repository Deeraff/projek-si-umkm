<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link href="{{ asset('resources/layouts/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-700">APP UMKM</h1>
            <nav class="space-x-6">
                <a href="#" class="text-green-600 font-semibold">Beranda</a>
                <a href="#" class="hover:text-green-600">Informasi</a>
                <a href="#" class="hover:text-green-600">Petunjuk</a>
                <a href="#" class="hover:text-green-600">Kontak</a>
            </nav>
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
