<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('resources/layouts/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-xl px-10 py-8 text-left bg-white shadow-lg rounded-lg">
            <h3 class="text-3xl font-bold text-center mb-6">Login</h3>

            {{-- error message --}}
            @if ($errors->any())
                <div class="text-red-500 text-sm mt-2 mb-4 p-3 bg-red-100 border border-red-400 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- form login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-lg mb-2" for="email">Email</label>
                        <input type="email" name="email" id="email" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 text-lg">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-lg mb-2" for="password">Password</label>
                        <input type="password" name="password" id="password" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 text-lg">
                    </div>

                    <div class="flex items-baseline justify-between mt-6">
                        <button type="submit" 
                                class="px-8 py-3 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-300 text-lg font-semibold">
                            Login
                        </button>
                        <a href="{{ route('register') }}" class="text-md text-green-600 hover:underline font-medium">
                            Belum punya akun? Register
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
