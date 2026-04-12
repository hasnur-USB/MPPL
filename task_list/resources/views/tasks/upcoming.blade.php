@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold text-pink-600 flex items-center gap-3">
                📅 Upcoming Tasks
            </h2>
            <p class="text-pink-400">Task yang sudah dijadwalkan ✨</p>
        </div>

        <!-- Form Tambah Task di Upcoming -->
        <div class="bg-white rounded-3xl p-8 shadow-sm mb-12 border border-pink-100">
            <form action="{{ route('tasks.storeScheduled') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-6">
                        <input type="text" name="title"
                            class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-5 text-lg focus:outline-none placeholder:text-pink-300"
                            placeholder="Task yang mau dijadwalkan..." required>
                    </div>
                    <div class="md:col-span-4">
                        <label class="block text-pink-400 text-sm mb-2 font-medium">Tanggal</label>
                        <input type="date" name="due_date" value="{{ now()->format('Y-m-d') }}"
                            min="{{ now()->format('Y-m-d') }}"
                            class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-5 text-lg focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full bg-pink-500 hover:bg-pink-600 h-[58px] rounded-3xl text-white font-medium transition-all active:scale-95">
                            Jadwalkan 📅
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- List Upcoming Tasks -->
        @if ($tasks->isEmpty())
            <div class="bg-white/70 rounded-3xl p-20 text-center">
                <p class="text-6xl mb-6">📪</p>
                <p class="text-2xl text-gray-400">Belum ada task terjadwal</p>
                <p class="text-pink-300 mt-3">Tambahkan task dengan tanggal di form di atas</p>
            </div>
        @else
            @foreach ($tasks as $date => $taskList)
                @php $carbonDate = \Carbon\Carbon::parse($date); @endphp
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 bg-pink-100 rounded-3xl flex items-center justify-center text-4xl shadow-inner">
                            {{ $carbonDate->format('d') }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-pink-700">{{ $carbonDate->format('l') }}</h3>
                            <p class="text-pink-400">{{ $carbonDate->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="space-y-4 pl-6">
                        @foreach ($taskList as $task)
                            <div
                                class="bg-white border border-pink-100 rounded-3xl p-6 flex items-center gap-5 group hover:shadow-md transition-all">
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="focus:outline-none">
                                        <input type="checkbox" {{ $task->is_done ? 'checked' : '' }}
                                            class="w-7 h-7 accent-pink-500 cursor-pointer rounded-xl">
                                    </button>
                                </form>

                                <span
                                    class="flex-1 text-lg {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                    {{ $task->title }}
                                </span>

                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="text-amber-400 hover:text-amber-500 text-2xl">
                                    ✏️
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus task ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-300 hover:text-red-500 text-2xl">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
