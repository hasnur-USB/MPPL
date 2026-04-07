<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Sistem Informasi Pengelolaan Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }
    </script>
</head>

<body
    class="bg-gradient-to-br from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 font-inter text-gray-800 dark:text-gray-200">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-900 shadow-md fixed top-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-700 dark:text-blue-400">SIP Barang</h1>
            <div class="space-x-6 flex items-center">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 border border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-800 transition">Register</a>
                <button onclick="toggleDarkMode()"
                    class="ml-4 px-3 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    🌙 / ☀️
                </button>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="pt-32 pb-20 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700 dark:text-blue-400 mb-6">Sistem Informasi
            Pengelolaan Barang</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-8">
            Selamat datang di aplikasi <span class="font-semibold text-blue-600 dark:text-blue-400">SIP Barang</span>.
            Aplikasi ini membantu Anda dalam mengelola data barang, stok, dan laporan dengan cara yang lebih mudah,
            cepat, dan terstruktur.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl shadow hover:bg-blue-700 transition">Masuk
                Sekarang</a>
            <a href="{{ route('register') }}"
                class="px-6 py-3 border border-blue-600 text-blue-600 dark:text-blue-400 font-medium rounded-xl hover:bg-blue-50 dark:hover:bg-gray-800 transition">Daftar</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white dark:bg-gray-900 py-16">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div
                class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gradient-to-br from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
                <h3 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-400">Manajemen Barang</h3>
                <p class="text-gray-600 dark:text-gray-300">Catat, kelola, dan update informasi barang dengan mudah.</p>
            </div>
            <div
                class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gradient-to-br from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
                <h3 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-400">Stok Otomatis</h3>
                <p class="text-gray-600 dark:text-gray-300">Pantau persediaan barang secara real-time untuk mencegah
                    kekurangan atau kelebihan stok.</p>
            </div>
            <div
                class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gradient-to-br from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
                <h3 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-400">Laporan Cepat</h3>
                <p class="text-gray-600 dark:text-gray-300">Hasilkan laporan barang dan stok dengan cepat dan akurat.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-900 py-6 mt-10">
        <div class="max-w-6xl mx-auto px-6 text-center text-gray-600 dark:text-gray-400">
            © 2025 Sistem Informasi Pengelolaan Barang. Dibuat dengan ❤️ menggunakan Laravel & TailwindCSS.
        </div>
    </footer>
</body>

</html>
