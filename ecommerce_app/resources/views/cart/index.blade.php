<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Keranjang Belanja</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('cart'))
                    <table class="w-full text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-4 text-left font-bold text-gray-700">Gambar</th>

                                <th class="p-4 text-left font-bold text-gray-700">Nama Barang</th>
                                <th class="p-4 text-left font-bold text-gray-700">Harga</th>
                                <th class="p-4 text-left font-bold text-gray-700">Jumlah</th>
                                <th class="p-4 text-left font-bold text-gray-700">Subtotal</th>
                                <th class="p-4 text-left font-bold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart') as $id => $details)
                                <tr class="border-b">
                                    <td class="p-4">
                                        @if (isset($details['gambar']) && $details['gambar'])
                                            <img src="{{ asset('storage/' . $details['gambar']) }}" alt="Gambar"
                                                class="h-16 w-16 object-cover rounded shadow-sm">
                                        @else
                                            <div
                                                class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">
                                                No Image</div>
                                        @endif
                                    </td>
                                    <td class="p-4 font-semibold text-gray-800">{{ $details['nama_barang'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-2xl font-bold text-gray-800">
                            Total: Rp {{ number_format($total, 0, ',', '.') }}
                        </div>

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition">
                                Proses Checkout Sekarang
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
