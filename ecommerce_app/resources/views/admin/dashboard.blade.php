<x-app-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <div class="space-y-8 p-6">

        <!-- Welcome Banner -->
        <div
            class="bg-blue-600 rounded-3xl p-8 sm:p-10 text-white shadow-lg shadow-blue-500/20 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute right-20 -bottom-10 w-40 h-40 rounded-full bg-blue-400/20 blur-2xl"></div>

            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold tracking-tight mb-2">
                    Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                </h2>
                <p class="text-blue-100 text-sm max-w-xl leading-relaxed">
                    Pantau performa toko, kelola barang, dan periksa pesanan masuk terbaru hari ini.
                </p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Pesanan Masuk -->
            <div
                class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Pesanan Masuk</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $pendingOrders ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Menunggu diproses</p>
                </div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div
                class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Pendapatan Bulan Ini</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">
                        Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Barang Aktif -->
            <div
                class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Barang Aktif</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $activeProducts ?? 0 }}</p>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
