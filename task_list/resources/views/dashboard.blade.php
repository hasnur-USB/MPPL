@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold text-pink-600 flex items-center gap-3">
                📌 Today's Tasks 🐰
            </h2>
            <p class="text-pink-400">{{ now()->format('l, d F Y') }}</p>
        </div>

        <!-- Form Tambah Task -->
        <div class="bg-white rounded-3xl p-6 shadow mb-10">
            <form action="#" method="POST">
                @csrf
                <div class="flex gap-4">
                    <input type="text" name="title"
                        class="flex-1 border border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-5 text-lg focus:outline-none"
                        placeholder="Apa yang mau kamu kerjakan hari ini?">
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 px-10 py-5 rounded-3xl text-white font-medium transition-all">
                        Tambah ✨
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center text-gray-400 py-10">
            Task list masih kosong nih...<br>
            Tambahin task dulu yuk 🥰
        </div>

    </div>
@endsection
