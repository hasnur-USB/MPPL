<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="p-6 space-y-6">

                        <!-- Nama Barang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('nama_barang')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                            <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 
                                          file:rounded-xl file:border-0 file:text-sm file:font-medium 
                                          file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-2">Format yang diizinkan: JPG, JPEG, PNG, WEBP. Maksimal
                                2MB.</p>
                            @error('gambar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga & Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                                <input type="number" name="harga" value="{{ old('harga') }}"
                                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                    min="0" required>
                                @error('harga')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stok" value="{{ old('stok') }}"
                                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                    min="0" required>
                                @error('stok')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t">
                        <a href="{{ route('admin.barang.index') }}"
                            class="px-5 py-2.5 text-gray-600 hover:text-gray-800 font-medium">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">
                            Simpan Barang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
