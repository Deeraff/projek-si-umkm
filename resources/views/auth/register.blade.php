<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrasi - UMKM Sukorame</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Inter', sans-serif;
    }
    .bg-image {
      background-image: url('{{ asset("assets/go-online.jpg") }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body class="bg-image text-white flex items-center justify-center min-h-screen relative overflow-hidden">

  <!-- Overlay gelap -->
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

  <!-- Kontainer utama -->
  <div class="relative w-[90%] max-w-6xl h-[90vh] flex rounded-3xl overflow-hidden shadow-2xl border border-white/10">

    <!-- Kiri: Form registrasi -->
    <div class="w-1/2 bg-black/60 p-10 flex flex-col justify-center backdrop-blur-md relative z-10">
      <h1 class="text-3xl font-bold text-center mb-8 leading-tight">
        Daftarkan Akun Anda di<br>
        <span class="text-green-400 font-extrabold text-4xl">UMKM SUKORAME</span>
      </h1>

      {{-- Pesan error --}}
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4 text-sm">
          <ul class="list-disc pl-4">
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
          <label for="name" class="block font-medium mb-1">Nama Lengkap</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required
            class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none" />
        </div>

        <div>
          <label for="email" class="block font-medium mb-1">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none" />
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label for="password" class="block font-medium mb-1">Password</label>
            <input type="password" id="password" name="password" required
              class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none" />
          </div>
          <div>
            <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
              class="w-full px-4 py-2 rounded-md text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none" />
          </div>
        </div>

        <button type="submit"
          class="w-full py-2 mt-2 bg-green-600 hover:bg-green-700 rounded-md font-bold text-white shadow-lg transition">
          Daftar Sekarang
        </button>
      </form>

      <p class="text-center text-gray-200 text-sm mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-semibold">Masuk</a>
      </p>
    </div>

    <!-- Kanan: Logo dan branding -->
    <div class="w-1/2 flex flex-col items-center justify-center text-center relative">
      <div class="z-10">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo UMKM" class="w-28 h-28 mx-auto rounded-full bg-white p-3 border-4 border-green-400 shadow-xl mb-6">
        <h1 class="text-6xl font-black text-green-400 drop-shadow-lg">UMKM</h1>
        <h2 class="text-5xl font-black text-white drop-shadow-lg -mt-2">SUKORAME</h2>
        <p class="mt-5 text-gray-100 text-lg font-medium max-w-sm mx-auto">
          Meningkatkan daya saing dan pemasaran produk lokal melalui platform digital.
        </p>
      </div>
    </div>
  </div>

</body>
</html>
