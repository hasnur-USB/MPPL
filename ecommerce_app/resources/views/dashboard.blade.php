<x-app-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <div class="space-y-8">

        <div
            class="bg-blue-600 rounded-3xl p-8 sm:p-10 text-white shadow-lg shadow-blue-500/20 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-64 h-64 rounded-full bg-white/10 blur-3xl pointer-events-none">
            </div>
            <div class="absolute right-20 -bottom-10 w-40 h-40 rounded-full bg-blue-400/20 blur-2xl pointer-events-none">
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold tracking-tight mb-2">
                    Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                </h2>
                <p class="text-blue-100 text-sm max-w-xl leading-relaxed">
                    Pantau aktivitas terbaru Anda dan lihat ringkasan toko hari ini. Semua yang Anda butuhkan ada di
                    sini.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

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
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12% Hari ini</span>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Total Pesanan</p>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">142</p>
                </div>
            </div>

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
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Aktivitas Transaksi</p>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">Rp 2.4M</p>
                </div>
            </div>

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
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Item Aktif</p>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">89</p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h3>
                <button class="text-sm font-bold text-blue-600 hover:text-blue-700">Lihat Semua</button>
            </div>
            <div class="p-8 text-center">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-gray-900 font-bold mb-1">Belum ada aktivitas</h4>
                <p class="text-sm text-gray-500">Data transaksi atau pesanan Anda akan muncul di sini.</p>
            </div>
        </div>

    </div>
</x-app-layout>
