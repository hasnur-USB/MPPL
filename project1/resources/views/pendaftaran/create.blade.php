<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Gambar Barang</label>
                            <input type="file" name="gambar" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Kode Barang</label>
                            <input type="text" name="kode_barang" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: BRG-001">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Nama Barang</label>
                            <input type="text" name="nama_barang" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: Apel Fuji">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Kategori</label>
                                <input type="text" name="kategori" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: Buah-buahan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Satuan</label>
                                <input type="text" name="satuan" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: Kg, Pcs, Box">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium mb-1">Stok</label>
                                <input type="number" name="stok" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Harga (Rp)</label>
                                <input type="number" name="harga" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="20000">
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('pendaftaran.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan Barang</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>