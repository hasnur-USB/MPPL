@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-8 text-gray-800">🛒 Keranjang Belanja</h1>

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
                <div class="text-center py-16 bg-white rounded-xl shadow">
                    <p class="text-2xl text-gray-500 mb-4">Keranjang Anda kosong</p>
                    <a href="{{ route('katalog.index') }}"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        🛍️ Mulai Belanja
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left">Produk</th>
                                <th class="px-6 py-4 text-center">Harga</th>
                                <th class="px-6 py-4 text-center">Jumlah</th>
                                <th class="px-6 py-4 text-right">Subtotal</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            @if ($item->barang->gambar)
                                                <img src="{{ $item->barang->gambar }}"
                                                    alt="{{ $item->barang->nama_barang }}"
                                                    class="w-16 h-16 object-cover rounded">
                                            @endif
                                            <div>
                                                <p class="font-semibold">{{ $item->barang->nama_barang }}</p>
                                                <p class="text-sm text-gray-500">Stok: {{ $item->barang->stok }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        Rp {{ number_format($item->barang->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="qty" value="{{ $item->qty }}" min="1"
                                                class="w-16 text-center border rounded py-1">
                                            <button type="submit"
                                                class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-6 text-right font-medium">
                                        Rp {{ number_format($item->qty * $item->barang->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus barang ini dari keranjang?')"
                                                class="text-red-600 hover:text-red-800">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="bg-gray-50 px-6 py-6 border-t">
                        <div class="flex justify-between items-center text-xl font-bold">
                            <span>Total:</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('checkout.store') }}"
                        class="bg-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 transition text-lg">
                        🛒 Lanjut ke Checkout
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
