<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Daftar Barang</h3>
                        <a href="{{ route('barang.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Barang
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-700 dark:border-green-600 dark:text-green-100 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">No.</th>
                                    <th scope="col" class="py-3 px-6">Gambar</th>
                                    <th scope="col" class="py-3 px-6">Kode Barang</th>
                                    <th scope="col" class="py-3 px-6">Nama Barang</th>
                                    <th scope="col" class="py-3 px-6">Kategori</th>
                                    <th scope="col" class="py-3 px-6">Stok</th>
                                    <th scope="col" class="py-3 px-6">Harga</th>
                                    <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $index => $barang)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6">{{ $barangs->firstItem() + $index }}</td>
                                        <td class="py-4 px-6">
                                            @if ($barang->gambar)
                                                <img class="w-10 h-10 rounded-md object-cover"
                                                    src="{{ asset('storage/' . $barang->gambar) }}"
                                                    alt="{{ $barang->nama_barang }}">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs">
                                                    N/A</div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">
                                            {{ $barang->kode_barang }}</td>
                                        <td class="py-4 px-6">{{ $barang->nama_barang }}</td>
                                        <td class="py-4 px-6">{{ $barang->kategori }}</td>
                                        <td class="py-4 px-6">{{ $barang->stok }} {{ $barang->satuan }}</td>
                                        <td class="py-4 px-6">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                        <td class="py-4 px-6">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('barang.edit', $barang->id) }}"
                                                    class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('barang.destroy', $barang->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"
                                            class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                                            Data barang belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $barangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
