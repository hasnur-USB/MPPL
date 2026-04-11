<x-app-layout>
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 rounded-lg shadow">
                <h2 class="text-3xl font-bold text-green-600">Terima Kasih!</h2>
                <p class="mt-4 text-gray-600">Pesanan Anda berhasil diproses. Admin akan segera mengecek pesanan Anda.</p>
                <a href="{{ route('katalog.index') }}" class="mt-6 inline-block text-blue-500 underline">Kembali Belanja</a>
            </div>
        </div>
    </div>
</x-app-layout>