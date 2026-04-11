<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Pesanan Masuk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="p-3">ID Order</th>
                            <th class="p-3">Pelanggan</th>
                            <th class="p-3">Total Harga</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-bold">#{{ $order->id }}</td>
                                <td class="p-3">{{ $order->user->name }}</td>
                                <td class="p-3">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-bold 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="p-3">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="text-blue-600 hover:text-blue-900 font-medium underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-500">Belum ada pesanan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
