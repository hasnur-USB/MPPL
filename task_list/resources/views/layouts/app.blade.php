<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiyowo Planner 🐰</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Lucu -->
        <div class="w-72 bg-white border-r border-pink-200 shadow-2xl flex flex-col">

            <div class="p-6 border-b border-pink-100 flex items-center gap-3">
                <span class="text-4xl">🐰</span>
                <div>
                    <h1 class="text-3xl font-bold text-pink-500 tracking-tight">Kiyowo</h1>
                    <p class="text-pink-400 text-sm -mt-1">daily planner</p>
                </div>
            </div>

            <nav class="flex-1 p-6 space-y-2">
                <!-- Today -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl transition-all font-medium
                {{ request()->routeIs('dashboard') ? 'bg-pink-100 text-pink-600' : 'hover:bg-pink-100 text-gray-600 hover:text-pink-600' }}">
                    🏠 Today
                </a>

                <!-- Upcoming -->
                <a href="{{ route('upcoming') }}"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl transition-all font-medium
                {{ request()->routeIs('upcoming') ? 'bg-pink-100 text-pink-600' : 'hover:bg-pink-100 text-gray-600 hover:text-pink-600' }}">
                    📅 Upcoming
                </a>

                <!-- Diary -->
                <a href="{{ route('diary.index') }}"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl transition-all font-medium
                {{ request()->routeIs('diary.index') ? 'bg-pink-100 text-pink-600' : 'hover:bg-pink-100 text-gray-600 hover:text-pink-600' }}">
                    📔 My Diary
                </a>

                <!-- Habits  -->
                <a href="#"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl hover:bg-pink-100 transition-all text-gray-600 hover:text-pink-600 font-medium">
                    🌱 Habits
                </a>

                <!-- Stats -->
                <a href="#"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl hover:bg-pink-100 transition-all text-gray-600 hover:text-pink-600 font-medium">
                    📊 Stats
                </a>
            </nav>

            <!-- Bagian User -->
            <div class="p-6 border-t border-pink-100 mt-auto">
                <div class="flex items-center gap-3 bg-pink-50 rounded-3xl p-4">
                    <!-- Avatar -->
                    <div
                        class="w-11 h-11 bg-pink-200 rounded-2xl overflow-hidden border-2 border-pink-300 flex-shrink-0">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-3xl">🥰</div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <a href="{{ route('profile.edit') }}"
                            class="font-medium text-pink-700 truncate hover:text-pink-600 transition-colors">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-xs text-pink-400">Semangat hari ini ! ✨</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-pink-400 hover:text-red-500 text-sm font-medium">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <main class="p-8">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- Script Tanggal Real-time -->
    <script>
        function updateCurrentDate() {
            const dateElement = document.getElementById('current-date');
            if (!dateElement) return;

            const now = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };

            // Format bahasa Indonesia
            const formatted = now.toLocaleDateString('id-ID', options);
            dateElement.textContent = formatted;
        }

        // Jalankan saat halaman load
        window.onload = updateCurrentDate;

        // Update setiap 30 menit sekali 
        setInterval(updateCurrentDate, 1800000);
    </script>

</body>

</html>
