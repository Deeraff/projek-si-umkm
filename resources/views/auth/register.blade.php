<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi - UMKM Sukorame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap');
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
        .bg-image {
            /* Pastikan path ke gambar benar */
            background-image: url('{{ asset("assets/go-online.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-image text-white flex items-center justify-center min-h-screen relative p-4">

    <div class="absolute inset-0 bg-black/70 backdrop-blur-md"></div>

    <div class="relative w-full max-w-6xl h-auto lg:h-[80vh] flex flex-col lg:flex-row rounded-3xl overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.8)] border border-white/20">

        <div class="w-full lg:w-1/2 bg-black/60 p-8 md:p-12 flex flex-col justify-center backdrop-blur-sm relative z-10">
            <h1 class="text-3xl font-extrabold text-center mb-4 leading-snug">
                Daftar Akun
            </h1>
            <h2 class="text-xl font-bold text-center mb-8 text-green-400">
                Pemilik UMKM Sukorame
            </h2>

            {{-- Pesan error --}}
            @if ($errors->any())
                <div class="text-sm mb-4 p-3 bg-red-900/40 border border-red-500/30 rounded-lg shadow-inner">
                    <ul class="list-disc ml-5 text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form register --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block font-medium mb-1 text-gray-300">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition" 
                            placeholder="Masukkan Nama Lengkap"/>
                    </div>
                </div>

                <div>
                    <label for="email" class="block font-medium mb-1 text-gray-300">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition" 
                            placeholder="Masukkan Email"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block font-medium mb-1 text-gray-300">Password</label>
                        <div class="relative">
                             <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition" 
                                placeholder="Buat Password"/>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block font-medium mb-1 text-gray-300">Konfirmasi Password</label>
                         <div class="relative">
                             <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg text-gray-900 bg-white shadow-inner focus:ring-2 focus:ring-green-500 focus:outline-none transition" 
                                placeholder="Ulangi Password"/>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 mt-4 bg-green-600 hover:bg-green-700 rounded-lg font-bold text-white text-lg tracking-wider shadow-xl shadow-green-900/40 transition transform hover:scale-[1.01]">
                    DAFTAR AKUN
                </button>
            </form>

            <p class="text-center text-gray-300 text-sm mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-bold underline-offset-4 hover:underline transition">Masuk</a>
            </p>
        </div>

        <div class="hidden lg:flex w-1/2 flex-col items-center justify-center p-12 text-center bg-black/30">
            <div class="z-10">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo UMKM" class="w-32 h-32 mx-auto rounded-full bg-white p-3 border-4 border-green-400 shadow-2xl mb-6">
                <h1 class="text-6xl font-black text-green-400 drop-shadow-lg leading-none">UMKM</h1>
                <h2 class="text-5xl font-black text-white drop-shadow-lg -mt-1 leading-none">SUKORAME</h2>
                <p class="mt-6 text-gray-200 text-lg font-medium max-w-sm mx-auto">
                    Meningkatkan daya saing dan pemasaran produk lokal melalui platform digital.
                </p>
            </div>
        </div>
    </div>

</body>
</html>