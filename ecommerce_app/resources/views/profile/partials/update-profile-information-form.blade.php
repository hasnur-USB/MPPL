<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Perbarui data diri dan foto profil akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
            <div class="relative group">
                <div
                    class="w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-sm transition-all group-hover:ring-4 group-hover:ring-blue-50">
                    @if ($user->profile_photo)
                        <img id="avatar-preview" src="{{ asset('storage/' . $user->profile_photo) }}"
                            class="w-full h-full object-cover">
                    @else
                        <div id="avatar-placeholder"
                            class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <img id="avatar-preview" class="hidden w-full h-full object-cover">
                    @endif
                </div>
                <label for="profile_photo"
                    class="absolute -bottom-1 -right-1 bg-white p-1.5 rounded-full shadow-md border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <input type="file" id="profile_photo" name="profile_photo" class="hidden"
                        onchange="previewImage(this)" accept="image/*">
                </label>
            </div>
            <div>
                <h4 class="text-sm font-bold text-gray-700">Foto Profil</h4>
                <p class="text-xs text-gray-500 mt-1">PNG atau JPG, Maksimal 2MB.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')"
                    class="text-xs uppercase tracking-widest text-gray-400 font-bold ml-1" />
                <x-text-input id="name" name="name" type="text"
                    class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email Address')"
                    class="text-xs uppercase tracking-widest text-gray-400 font-bold ml-1" />
                <x-text-input id="email" name="email" type="email"
                    class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800">
                            {{ __('Email Anda belum diverifikasi.') }}
                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3.5 px-10 rounded-xl transition-all duration-200 shadow-lg shadow-blue-500/20 active:scale-[0.98] border-none outline-none">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-semibold">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        {{ __('Tersimpan') }}
                    </span>
                </p>
            @endif
        </div>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>
