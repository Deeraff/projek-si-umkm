<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Sukorame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }
        .bg-image {
            background-image: url('{{ asset('assets/go-online.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-image flex items-center justify-center relative min-h-screen">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <!-- Container utama -->
    <div class="relative w-[90%] max-w-6xl h-[90vh] flex rounded-3xl overflow-hidden shadow-2xl border border-white/10">

        <!-- Kolom kiri: Form login -->
        <div class="w-full lg:w-1/2 bg-black/60 backdrop-blur-md flex flex-col justify-center p-10 text-white">
            <h1 class="text-3xl font-bold text-center mb-8 leading-tight">
                Selamat Datang di<br>
                <span class="text-green-400 text-4xl font-extrabold">Website UMKM SUKORAME</span>
            </h1>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="text-red-400 text-sm mb-4 p-3 bg-red-900/40 border border-red-500/30 rounded-md">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-5">

                    <div>
                        <label for="email" class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none"
                            placeholder="Masukkan Email">
                    </div>

                    <div>
                        <label for="password" class="block font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none"
                            placeholder="Masukkan Password">
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-300">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-green-500 border-gray-300 rounded bg-white focus:ring-green-400 cursor-pointer">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="text-green-400 hover:text-green-300 font-semibold">Lupa Password?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-2 mt-2 bg-green-600 hover:bg-green-700 rounded-md font-bold text-white shadow-lg transition">
                        Login
                    </button>

                    <p class="text-center text-gray-200 text-sm mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-semibold">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Kolom kanan: Logo dan branding -->
        <div class="hidden lg:flex w-1/2 flex-col items-center justify-center text-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo UMKM" class="w-28 h-28 mx-auto rounded-full bg-white p-3 border-4 border-green-400 shadow-xl mb-6">
            <h1 class="text-6xl font-black text-green-400 drop-shadow-lg">UMKM</h1>
            <h2 class="text-5xl font-black text-white drop-shadow-lg -mt-2">SUKORAME</h2>
            <p class="mt-5 text-gray-100 text-lg font-medium max-w-sm mx-auto">
                Pusat produk unggulan Usaha Mikro Kecil dan Menengah.
            </p>
        </div>
    </div>

</body>
</html>
