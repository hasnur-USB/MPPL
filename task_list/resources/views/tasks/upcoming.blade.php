@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-12">
            <h2 class="text-4xl font-bold text-pink-600 flex items-center gap-3">
                📅 Upcoming Tasks 🐰
            </h2>
            <p class="text-pink-400">Rencana kamu beberapa hari ke depan ✨</p>
        </div>

        @if ($tasks->isEmpty())
            <div class="bg-white rounded-3xl p-20 text-center border border-pink-100">
                <p class="text-6xl mb-6">🌸</p>
                <p class="text-2xl text-gray-400 mb-2">Tidak ada task mendatang nih...</p>
                <p class="text-pink-300">Yuk tambah task baru di halaman Today!</p>
            </div>
        @else
            @foreach ($tasks as $date => $taskList)
                @php
                    $carbonDate = \Carbon\Carbon::parse($date);
                    $isToday = $carbonDate->isToday();
                @endphp

                <div class="mb-14">
                    <!-- Header Tanggal Kiyowo -->
                    <div class="flex items-center gap-5 mb-6">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-pink-100 to-purple-100 rounded-3xl flex items-center justify-center text-4xl shadow-inner">
                            {{ $carbonDate->format('d') }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-pink-700">
                                {{ $carbonDate->format('l') }}
                            </h3>
                            <p class="text-pink-400">
                                {{ $carbonDate->format('d F Y') }}
                                @if ($isToday)
                                    <span class="ml-3 text-xs bg-pink-200 text-pink-700 px-4 py-1 rounded-2xl">Hari
                                        Ini</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Task List -->
                    <div class="space-y-4 pl-4">
                        @foreach ($taskList as $task)
                            <div
                                class="bg-white border border-pink-100 rounded-3xl p-6 flex items-center gap-6 group hover:shadow-md transition-all">

                                <!-- Checkbox -->
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="focus:outline-none">
                                        <input type="checkbox" {{ $task->is_done ? 'checked' : '' }}
                                            class="w-7 h-7 accent-pink-500 cursor-pointer rounded-2xl">
                                    </button>
                                </form>

                                <!-- Title -->
                                <span
                                    class="flex-1 text-lg {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                    {{ $task->title }}
                                </span>

                                <!-- Edit Button -->
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="text-amber-400 hover:text-amber-500 text-2xl opacity-70 hover:opacity-100 transition-all">
                                    ✏️
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
