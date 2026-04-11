<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Toko Kita</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

<body class="antialiased bg-gray-50 font-sans text-gray-900">
    <div class="relative min-h-screen flex flex-col">

        @if (Route::has('login'))
            <nav class="w-full bg-white shadow-sm px-6 py-4 flex justify-between items-center fixed top-0 z-50">
                <div class="text-2xl font-extrabold text-blue-600 tracking-tighter">
                    🛒 TokoKita
                </div>
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-blue-600 transition mr-4">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="font-semibold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-full shadow-md transition">Register</a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif

        <main class="flex-grow flex items-center justify-center pt-20">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <div
                    class="mb-6 inline-block bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide">
                    🎉 Selamat Datang di Pusat Belanja Terbaik
                </div>

                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                    Temukan Produk Impianmu dengan <span
                        class="text-blue-600 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Harga
                        Terbaik!</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                    Koleksi lengkap, transaksi aman, dan pengiriman cepat. Bergabunglah dengan ribuan pelanggan puas
                    lainnya sekarang juga.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-3.5 text-lg font-bold text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-8 py-3.5 text-lg font-bold text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Mulai Belanja Sekarang
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-8 py-3.5 text-lg font-bold text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm hover:bg-gray-50 transition-all duration-300">
                            Sudah Punya Akun?
                        </a>
                    @endauth
                </div>
            </div>
        </main>

        <footer class="py-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Toko Kita. Dibuat dengan 💙 menggunakan Laravel.
        </footer>
    </div>
</body>

</html>
