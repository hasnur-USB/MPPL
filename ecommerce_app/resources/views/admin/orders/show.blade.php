<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') }}{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:col-span-2">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">Informasi Pelanggan</h3>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Nama:</span> {{ $order->user->name }}</p>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="font-semibold text-gray-600">Tanggal Transaksi:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-blue-500">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">Status Pesanan</h3>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <select name="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses (Packing/Kirim)</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Rincian Barang</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-3">Nama Barang</th>
                                <th class="p-3">Harga Beli</th>
                                <th class="p-3">Jumlah</th>
                                <th class="p-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $item->barang ? $item->barang->nama_barang : 'Barang Dihapus' }}</td>
                                <td class="p-3">Rp {{ number_format($item->harga_saat_beli, 0, ',', '.') }}</td>
                                <td class="p-3">{{ $item->jumlah }}</td>
                                <td class="p-3 text-right font-medium">Rp {{ number_format($item->harga_saat_beli * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 border-t-2 border-gray-300">
                                <td colspan="3" class="p-4 text-right font-bold text-lg text-gray-700">Total Pembayaran:</td>
                                <td class="p-4 text-right font-bold text-xl text-blue-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:underline hover:text-gray-900">&larr; Kembali ke Daftar Pesanan</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>