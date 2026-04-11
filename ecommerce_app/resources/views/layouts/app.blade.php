<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TokoKita') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50/50" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden backdrop-blur-sm">
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="w-64 bg-white border-r border-gray-100 flex flex-col fixed h-full z-50 transition-transform duration-300 ease-in-out lg:translate-x-0">

            <div class="p-6 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <x-application-logo class="w-10 h-10 fill-current text-blue-600" />
                    {{-- <span class="text-xl font-bold tracking-tight text-gray-900">TokoKita</span> --}}
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden p-2 text-gray-400 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <p class="px-2 mb-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Menu Utama</p>

                <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span>Dashboard</span>
                </x-nav-link-sidebar>

                @if (Auth::user()->role === 'admin')
                    <p class="px-2 mt-6 mb-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Manajemen
                        Toko</p>
                    <x-nav-link-sidebar :href="route('admin.barang.index')" :active="request()->routeIs('admin.barang.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>Kelola Barang</span>
                    </x-nav-link-sidebar>

                    <x-nav-link-sidebar :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Pesanan Masuk</span>
                    </x-nav-link-sidebar>
                @endif

                @if (Auth::user()->role === 'customer')
                    <!-- Keranjang -->
                    <x-nav-link-sidebar :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span>Keranjang</span>
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('qty');
                        @endphp
                        @if ($cartCount > 0)
                            <span class="ml-auto bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full font-medium">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </x-nav-link-sidebar>

                    <!-- Riwayat Belanja -->
                    <x-nav-link-sidebar :href="route('riwayat.index')" :active="request()->routeIs('riwayat.index')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 01-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Riwayat Belanja</span>
                    </x-nav-link-sidebar>
                @endif
            </nav>

            <div class="p-4 border-t border-gray-100">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition-all group">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            class="w-9 h-9 rounded-full object-cover">
                    @else
                        <div
                            class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}</div>
                    @endif
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">
                            {{ Auth::user()->role }}</p>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 min-h-screen bg-[#fcfcfd] lg:ml-64 w-full">

            @if (isset($header))
                <header class="bg-white/40 backdrop-blur-md sticky top-0 z-30 border-b border-gray-100 lg:border-none">
                    <div class="px-6 lg:px-10 py-5 lg:py-7 flex items-end justify-between">

                        <div class="flex items-center gap-4">
                            <button @click="sidebarOpen = true"
                                class="lg:hidden p-2 text-gray-500 hover:bg-white hover:shadow-sm rounded-xl transition-all border border-transparent hover:border-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <h1 class="text-xl font-bold text-gray-900 tracking-tight leading-none">
                                {{ $header }}
                            </h1>
                        </div>

                        <div class="hidden sm:flex items-center gap-4 text-gray-400">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em]">
                                {{ date('l, d F Y') }}
                            </span>
                            <div class="h-3 w-[1px] bg-gray-200"></div>
                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </header>
            @endif

            <div class="p-6 lg:p-10 w-full overflow-x-hidden">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>

</html>
