<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Produk Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($barangs as $item)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-4 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}"
                                    class="w-full h-48 object-cover rounded-xl mb-4">
                            @else
                                <div
                                    class="w-full h-48 bg-gray-200 rounded-xl mb-4 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <h3 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $item->nama_barang }}</h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>

                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-blue-600 font-bold text-xl">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-500">Stok: {{ $item->stok }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition">
                                    + Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-xl shadow">
                        <p class="text-gray-500 italic text-lg">Maaf, saat ini belum ada produk tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
