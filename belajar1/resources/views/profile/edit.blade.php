<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- KODE UNTUK FOTO PROFIL DIMASUKKAN DI SINI --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Profile Photo') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your account's profile photo.") }}
                            </p>
                        </header>
                        {{-- Form Upload Foto --}}
                        <form method="post" action="{{ route('profile.update.photo') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            {{-- Tampilkan foto saat ini --}}
                            <div class="flex items-center gap-4">
                                @if (auth()->user()->photo_profile)
                                    <img src="{{ asset('storage/' . auth()->user()->photo_profile) }}" alt="Foto Profil"
                                        class="w-20 h-20 rounded-full object-cover">
                                @else
                                    {{-- Tampilkan avatar default jika tidak ada foto --}}
                                    <div
                                        class="w-20 h-20 rounded-full bg-gray-200 dark:bg-gray-900 flex items-center justify-center">
                                        <span
                                            class="text-2xl text-gray-500">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            {{-- Upload Foto Baru --}}
                            <div>
                                <x-input-label for="photo_profile" :value="__('New Photo')" />
                                <x-text-input id="photo_profile" name="photo_profile" type="file"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('photo_profile')" />
                            </div>
                            <div class="flex items-center gap-4">
                                {{-- Tombol Save --}}
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                @if (session('status') === 'photo-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
