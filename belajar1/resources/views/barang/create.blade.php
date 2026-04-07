<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="kode_barang" :value="__('Kode Barang')" />
                                <x-text-input id="kode_barang" class="block mt-1 w-full" type="text"
                                    name="kode_barang" :value="old('kode_barang')" required autofocus />
                                <x-input-error :messages="$errors->get('kode_barang')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                                <x-text-input id="nama_barang" class="block mt-1 w-full" type="text"
                                    name="nama_barang" :value="old('nama_barang')" required />
                                <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <x-text-input id="kategori" class="block mt-1 w-full" type="text" name="kategori"
                                    :value="old('kategori')" required />
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="satuan" :value="__('Satuan (e.g., Kg, Pcs)')" />
                                <x-text-input id="satuan" class="block mt-1 w-full" type="text" name="satuan"
                                    :value="old('satuan')" required />
                                <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="stok" :value="__('Stok')" />
                                <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok"
                                    :value="old('stok')" required />
                                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="harga" :value="__('Harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full" type="number" step="0.01"
                                    name="harga" :value="old('harga')" required />
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="gambar" :value="__('Gambar (Opsional)')" />
                            <x-text-input id="gambar"
                                class="block mt-1 w-full file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600"
                                type="file" name="gambar" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-4">
                            <a href="{{ route('barang.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-700">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
