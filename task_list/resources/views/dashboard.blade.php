@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold text-pink-600 flex items-center gap-3">
                📌 Today's Tasks 🐰
            </h2>
            <p class="text-pink-400 font-medium">{{ now()->format('l, d F Y') }}</p>
        </div>

        <!-- Form Tambah Task -->
        <div class="bg-white rounded-3xl p-8 shadow-sm mb-10 border border-pink-100">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="flex gap-4">
                    <input type="text" name="title"
                        class="flex-1 border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-5 text-lg focus:outline-none placeholder:text-pink-300"
                        placeholder="Apa yang mau kamu kerjakan hari ini? 🥰" required>
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 px-10 rounded-3xl text-white font-medium transition-all active:scale-95 shadow-md">
                        Tambah ✨
                    </button>
                </div>
            </form>
        </div>

        <!-- List Tasks -->
        <div class="space-y-4">
            @if ($tasks->isEmpty())
                <div class="bg-white/70 rounded-3xl p-16 text-center">
                    <p class="text-2xl mb-3">🌸</p>
                    <p class="text-gray-400 text-lg">Belum ada task hari ini...</p>
                    <p class="text-pink-300 text-sm mt-2">Yuk tambahin dulu biar hari ini lebih kiyowo!</p>
                </div>
            @else
                @foreach ($tasks as $task)
                    <div
                        class="bg-white border border-pink-100 rounded-3xl p-6 flex items-center gap-5 group hover:shadow-md transition-all">

                        <!-- Checkbox -->
                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="focus:outline-none">
                                <input type="checkbox" {{ $task->is_done ? 'checked' : '' }}
                                    class="w-7 h-7 accent-pink-500 cursor-pointer rounded-xl">
                            </button>
                        </form>

                        <!-- Title -->
                        <span class="flex-1 text-lg {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }}">
                            {{ $task->title }}
                        </span>

                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Yakin mau hapus task ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-300 hover:text-red-500 opacity-60 hover:opacity-100 transition-all text-xl">
                                🗑️
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        @if (session('success'))
            <div class="mt-6 bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-3xl text-center">
                {{ session('success') }}
            </div>
        @endif

    </div>
@endsection
