<x-guest-layout>
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 mt-2">Gabung dan mulai pengalaman belanja Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-8 flex flex-col items-center">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Foto Profil
                (Opsional)</label>
            <div class="relative group">
                <div
                    class="w-24 h-24 rounded-full bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden transition-all group-hover:border-blue-400 group-hover:bg-blue-50/30">
                    <svg id="preview-svg" class="w-8 h-8 text-gray-300 transition-colors group-hover:text-blue-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    <img id="preview-img" class="hidden w-full h-full object-cover">
                </div>

                <input type="file" name="profile_photo" class="absolute inset-0 opacity-0 cursor-pointer"
                    onchange="previewImage(this)" accept="image/*">

                <div
                    class="absolute -bottom-1 -right-1 bg-blue-600 text-white p-1.5 rounded-full shadow-lg border-2 border-white pointer-events-none group-hover:scale-110 transition-transform">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                        </path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        </div>

        <div class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama
                    Lengkap</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email
                    Address</label>
                <input id="email" type="email" name="email" :value="old('email')" required
                    autocomplete="username"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label
                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi
                    Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <button
            class="w-full mt-10 bg-gray-900 hover:bg-black text-white font-bold py-4 rounded-xl shadow-[0_10px_20px_rgba(0,0,0,0.1)] hover:shadow-[0_10px_25px_rgba(0,0,0,0.15)] transition-all duration-300">
            Daftar Sekarang
        </button>

        <div class="mt-10 text-center">
            <p class="text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-blue-600 font-bold hover:text-blue-700 transition-colors">Masuk di sini</a>
            </p>
        </div>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            const svg = document.getElementById('preview-svg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    svg.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-guest-layout>
