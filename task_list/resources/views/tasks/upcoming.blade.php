@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold text-pink-600 mb-10">📅 Upcoming Tasks</h2>

        @if ($tasks->isEmpty())
            <p class="text-center text-gray-400 py-20">Tidak ada task mendatang 🥺</p>
        @else
            @foreach ($tasks as $date => $taskList)
                <div class="mb-10">
                    <h3 class="text-pink-500 font-medium mb-4">{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</h3>
                    <div class="space-y-3">
                        @foreach ($taskList as $task)
                            <div class="bg-white border border-pink-100 rounded-3xl p-6 flex items-center gap-5">
                                <input type="checkbox" disabled {{ $task->is_done ? 'checked' : '' }}
                                    class="w-6 h-6 accent-pink-500">
                                <span
                                    class="{{ $task->is_done ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
