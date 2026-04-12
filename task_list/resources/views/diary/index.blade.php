@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold text-pink-600 flex items-center gap-3">
                📔 My Diary 🥰
            </h2>
            <p class="text-pink-400">Catatan harian si jagoan</p>
        </div>

        <!-- Form Upload Diary Hari Ini -->
        @if (!isset($hasTodayDiary) || !$hasTodayDiary)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-pink-100 mb-12">
                <h3 class="text-xl font-semibold text-pink-600 mb-6">📸 Buat Diary Hari Ini</h3>

                <form action="{{ route('diary.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Upload Foto -->
                        <div>
                            <label class="block text-pink-500 font-medium mb-3">Upload Foto Hari Ini</label>
                            <div
                                class="border-2 border-dashed border-pink-300 rounded-3xl p-8 text-center hover:border-pink-400 transition-all">
                                <input type="file" name="photo" id="photo" accept="image/*" class="hidden"
                                    required>
                                <label for="photo" class="cursor-pointer block">
                                    <span class="text-6xl mb-4 block">📸</span>
                                    <p class="text-pink-500 font-medium">Klik untuk upload foto</p>
                                    <p class="text-xs text-pink-400 mt-1">JPG, PNG, WebP • Maks 2MB</p>
                                </label>
                            </div>
                        </div>

                        <!-- Caption & Mood -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-pink-500 font-medium mb-2">Cerita Hari Ini (opsional)</label>
                                <textarea name="caption" rows="4"
                                    class="w-full border-2 border-pink-200 focus:border-pink-400 rounded-3xl px-6 py-4 focus:outline-none resize-none"
                                    placeholder="Hari ini aku..."></textarea>
                            </div>

                            <div>
                                <label class="block text-pink-500 font-medium mb-3">Mood Hari Ini</label>
                                <div class="flex gap-4">
                                    <button type="button" data-mood="happy"
                                        class="mood-btn text-4xl hover:scale-125 transition-transform">😊</button>
                                    <button type="button" data-mood="excited"
                                        class="mood-btn text-4xl hover:scale-125 transition-transform">🥳</button>
                                    <button type="button" data-mood="love"
                                        class="mood-btn text-4xl hover:scale-125 transition-transform">🥰</button>
                                    <button type="button" data-mood="calm"
                                        class="mood-btn text-4xl hover:scale-125 transition-transform">😌</button>
                                    <button type="button" data-mood="tired"
                                        class="mood-btn text-4xl hover:scale-125 transition-transform">🥱</button>
                                </div>
                                <input type="hidden" name="mood" id="selected-mood">
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-8 w-full bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-3xl font-medium transition-all active:scale-95">
                        Simpan Diary Hari Ini ✨
                    </button>
                </form>
            </div>
        @endif

        <!-- List Diary -->
        <h3 class="text-2xl font-semibold text-pink-600 mb-6">📖 Diary Sebelumnya</h3>

        @if ($diaries->isEmpty())
            <div class="bg-white/70 rounded-3xl p-20 text-center">
                <p class="text-5xl mb-6">📔</p>
                <p class="text-gray-400">Belum ada diary</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($diaries as $diary)
                    <div
                        class="bg-white border border-pink-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="h-64 bg-gray-100">
                            <img src="{{ asset('storage/' . $diary->photo) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <p class="text-pink-500 text-sm">{{ $diary->diary_date->format('d F Y') }}</p>
                                @if ($diary->mood)
                                    <span
                                        class="text-2xl">{{ $diary->mood === 'happy' ? '😊' : ($diary->mood === 'excited' ? '🥳' : ($diary->mood === 'love' ? '🥰' : ($diary->mood === 'calm' ? '😌' : '🥱'))) }}</span>
                                @endif
                            </div>
                            @if ($diary->caption)
                                <p class="text-gray-700 leading-relaxed">{{ $diary->caption }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.mood-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.mood-btn').forEach(b => b.style.transform = 'scale(1)');
                this.style.transform = 'scale(1.3)';
                document.getElementById('selected-mood').value = this.getAttribute('data-mood');
            });
        });
    </script>
@endsection
