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
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl bg-pink-100 text-pink-600 font-medium">
                    🏠 Today
                </a>
                <a href="#"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl hover:bg-pink-100 transition-all text-gray-600 hover:text-pink-600">
                    📅 Upcoming
                </a>
                <a href="#"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl hover:bg-pink-100 transition-all text-gray-600 hover:text-pink-600">
                    🌱 Habits
                </a>
                <a href="#"
                    class="flex items-center gap-4 px-5 py-4 rounded-3xl hover:bg-pink-100 transition-all text-gray-600 hover:text-pink-600">
                    📊 Stats
                </a>
            </nav>

            <!-- Bagian User -->
            <div class="p-6 border-t border-pink-100 mt-auto">
                <div class="flex items-center gap-3 bg-pink-50 rounded-3xl p-4">
                    <div class="w-10 h-10 bg-pink-300 rounded-2xl flex items-center justify-center text-2xl">🥰</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-pink-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-pink-400">Semangat hari ini beb! ✨</p>
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

</body>

</html>
