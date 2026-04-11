<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Belanja Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @forelse($orders as $order)
                    <div class="mb-6 border rounded-lg overflow-hidden shadow-sm">
                        <div class="bg-gray-100 px-6 py-4 border-b flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Transaksi:
                                    {{ $order->created_at->format('d M Y H:i') }}</p>
                                <p class="font-bold text-gray-800">Order ID: #{{ $order->id }}</p>
                            </div>
                            <div>
                                <span
                                    class="px-3 py-1 rounded text-sm font-bold 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            @foreach ($order->items as $item)
                                <div class="flex justify-between mb-2">
                                    <div>
                                        <p class="font-semibold">
                                            {{ $item->barang ? $item->barang->nama_barang : 'Barang telah dihapus' }}
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $item->jumlah }} x Rp
                                            {{ number_format($item->harga_saat_beli, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="font-medium">
                                        Rp {{ number_format($item->jumlah * $item->harga_saat_beli, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-4 pt-4 border-t flex justify-between items-center">
                                <p class="font-bold text-gray-700">Total Belanja:</p>
                                <p class="text-xl font-bold text-blue-600">Rp
                                    {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-gray-500 italic mb-4">Anda belum memiliki riwayat belanja.</p>
                        <a href="{{ route('katalog.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Mulai
                            Belanja</a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
