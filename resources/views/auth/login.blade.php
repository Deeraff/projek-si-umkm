<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Sukorame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap');
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Tetap hidden untuk tampilan full-screen */
            font-family: 'Inter', sans-serif;
        }
        .bg-image {
            /* Pastikan path ke gambar benar */
            background-image: url('{{ asset('assets/go-online.jpg') }}'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-image flex items-center justify-center relative min-h-screen p-4">

    <div class="absolute inset-0 bg-black/70 backdrop-blur-md"></div>

    <div class="relative w-full max-w-6xl h-auto lg:h-[80vh] flex flex-col lg:flex-row rounded-3xl overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.8)] border border-white/20">

        <div class="w-full lg:w-1/2 bg-black/60 backdrop-blur-sm flex flex-col justify-center p-8 md:p-12 text-white">
            <h1 class="text-3xl font-extrabold text-center mb-4 leading-snug">
                Login Akun
            </h1>
            <h2 class="text-xl font-bold text-center mb-8 text-green-400">
                Website UMKM Sukorame
            </h2>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="text-sm mb-4 p-3 bg-red-900/40 border border-red-500/30 rounded-lg shadow-inner">
                    <ul class="list-disc ml-5 text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-6">

                    <div>
                        <label for="email" class="block font-medium mb-1 text-gray-300">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                            <input type="email" name="email" id="email"
                                value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                                placeholder="Masukkan Email" required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block font-medium mb-1 text-gray-300">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                            <input type="password" name="password" id="password"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                                placeholder="Masukkan Password" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-green-500 border-gray-400 rounded bg-gray-700/50 focus:ring-green-400 cursor-pointer">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="text-green-400 hover:text-green-300 font-semibold transition">Lupa Password?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-green-600 hover:bg-green-700 rounded-lg font-bold text-white text-lg tracking-wider shadow-xl shadow-green-900/40 transition transform hover:scale-[1.01]">
                        MASUK
                    </button>

                    <p class="text-center text-gray-300 text-sm mt-4">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-bold underline-offset-4 hover:underline transition">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="hidden lg:flex w-1/2 flex-col items-center justify-center p-12 text-center bg-black/30">
             <img src="{{ asset('assets/logo.png') }}" alt="Logo UMKM" class="w-32 h-32 mx-auto rounded-full bg-white p-3 border-4 border-green-400 shadow-2xl mb-6">
             <h1 class="text-6xl font-black text-green-400 drop-shadow-lg leading-none">UMKM</h1>
             <h2 class="text-5xl font-black text-white drop-shadow-lg -mt-1 leading-none">SUKORAME</h2>
             <p class="mt-6 text-gray-200 text-lg font-medium max-w-sm mx-auto">
                 Pusat produk unggulan Usaha Mikro Kecil dan Menengah.
             </p>
        </div>
    </div>

</body>
</html>