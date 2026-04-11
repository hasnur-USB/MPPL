<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4 border p-4 rounded bg-gray-50">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk</label>
                        
                        @if($barang->gambar)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Lama" class="h-32 w-32 object-cover rounded shadow">
                            </div>
                        @endif

                        <input type="file" name="gambar" accept="image/*"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full bg-white p-2">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
                            <input type="number" name="harga"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                value="{{ old('harga', $barang->harga) }}" required min="0">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stok</label>
                            <input type="number" name="stok"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                value="{{ old('stok', $barang->stok) }}" required min="0">
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-3">
                        <a href="{{ route('admin.barang.index') }}"
                            class="text-gray-600 hover:text-gray-900 underline">Batal</a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Update Barang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>