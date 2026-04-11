@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto">

        <div class="bg-white rounded-3xl p-10 shadow-sm border border-pink-100">
            <h2 class="text-3xl font-bold text-pink-600 mb-8 flex items-center gap-3">
                ✏️ Edit Task
            </h2>

            <form action="{{ route('tasks.updateTitle', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-8">
                    <label class="block text-pink-500 font-medium mb-3 text-lg">Judul Task</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                        class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-5 text-lg focus:outline-none"
                        required>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('dashboard') }}"
                        class="flex-1 text-center py-5 border-2 border-pink-300 text-pink-600 font-medium rounded-3xl hover:bg-pink-50 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 bg-pink-500 hover:bg-pink-600 text-white font-medium py-5 rounded-3xl transition-all active:scale-95">
                        Simpan Perubahan ✨
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
