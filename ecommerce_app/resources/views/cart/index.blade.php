<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Keranjang Belanja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($cartItems->isEmpty())
                        <div class="text-center py-16">
                            <p class="text-2xl text-gray-500 mb-6">Keranjang Anda kosong</p>
                            <a href="{{ route('katalog.index') }}"
                                class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition text-lg">
                                🛍️ Mulai Belanja Sekarang
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-4 px-6">Produk</th>
                                        <th class="py-4 px-6 text-center">Harga Satuan</th>
                                        <th class="py-4 px-6 text-center">Jumlah</th>
                                        <th class="py-4 px-6 text-right">Subtotal</th>
                                        <th class="py-4 px-6"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="py-6 px-6">
                                                <div class="flex items-center gap-4">
                                                    @if ($item->barang && $item->barang->gambar)
                                                        <img src="{{ $item->barang->gambar }}"
                                                            alt="{{ $item->barang->nama_barang ?? 'Produk' }}"
                                                            class="w-16 h-16 object-cover rounded-lg">
                                                    @endif
                                                    <div>
                                                        <p class="font-medium">
                                                            {{ $item->barang->nama_barang ?? 'Nama Barang' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-6 px-6 text-center">
                                                Rp {{ number_format($item->barang->harga ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="py-6 px-6">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="flex justify-center items-center gap-3">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="qty" value="{{ $item->qty }}"
                                                        min="1"
                                                        class="w-20 text-center border border-gray-300 rounded py-2">
                                                    <button type="submit"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="py-6 px-6 text-right font-medium">
                                                Rp
                                                {{ number_format(($item->qty ?? 1) * ($item->barang->harga ?? 0), 0, ',', '.') }}
                                            </td>
                                            <td class="py-6 px-6 text-right">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Hapus barang ini dari keranjang?')"
                                                        class="text-red-600 hover:text-red-800 font-medium">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 border-t pt-8 flex justify-between items-center text-xl font-bold">
                            <span>Total Pembayaran:</span>
                            <span>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <!-- TOMBOL CHECKOUT YANG SUDAH DIPERBAIKI -->
                        <div class="mt-10 flex justify-end">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-2xl text-lg font-semibold transition">
                                    🛒 Lanjut ke Checkout →
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
