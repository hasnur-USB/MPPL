@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">

        <div class="bg-white rounded-3xl p-10 shadow-sm border border-pink-100">
            <h2 class="text-3xl font-bold text-pink-600 mb-10 flex items-center gap-3">
                👤 Profile Kamu 🥰
            </h2>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Avatar Section -->
                <div class="flex flex-col items-center mb-10">
                    <div
                        class="w-36 h-36 bg-gradient-to-br from-pink-100 to-purple-100 rounded-3xl overflow-hidden border-4 border-white shadow-md mb-5">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-7xl">🥰</div>
                        @endif
                    </div>

                    <label
                        class="cursor-pointer bg-pink-500 hover:bg-pink-600 text-white px-8 py-3.5 rounded-3xl text-sm font-medium transition-all active:scale-95">
                        📸 Ganti Foto Profil
                        <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp" class="hidden">
                    </label>
                    <p class="text-xs text-pink-400 mt-2">Maksimal 2MB (JPG, PNG, WebP)</p>
                </div>

                <!-- Nama -->
                <div class="mb-6">
                    <label class="block text-pink-500 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-4 text-lg focus:outline-none">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-8">
                    <label class="block text-pink-500 font-medium mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-4 text-lg focus:outline-none">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="{{ route('dashboard') }}"
                        class="flex-1 text-center py-4 border-2 border-pink-300 text-pink-600 font-medium rounded-3xl hover:bg-pink-50 transition-all">
                        Kembali ke Dashboard
                    </a>
                    <button type="submit"
                        class="flex-1 bg-pink-500 hover:bg-pink-600 text-white font-medium py-4 rounded-3xl transition-all active:scale-95">
                        Simpan Perubahan ✨
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
