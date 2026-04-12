<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::where('user_id', Auth::id())->orderBy('diary_date', 'desc')->get();

        return view('diary.index', compact('diaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'nullable|string|max:500',
            'mood' => 'nullable|string',
        ]);

        // Cek apakah sudah ada diary hari ini
        $today = now()->toDateString();
        if (Diary::where('user_id', Auth::id())->where('diary_date', $today)->exists()) {
            return redirect()->route('diary.index')->with('error', 'Kamu sudah membuat diary hari ini 🥰');
        }

        $path = $request->file('photo')->store('diaries', 'public');

        Diary::create([
            'user_id' => Auth::id(),
            'photo' => $path,
            'caption' => $request->caption,
            'mood' => $request->mood,
            'diary_date' => $today,
        ]);

        return redirect()->route('diary.index')->with('success', 'Diary hari ini berhasil disimpan 🥰✨');
    }
}
