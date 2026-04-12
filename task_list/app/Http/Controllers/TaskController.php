<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->where('due_date', today())->orderBy('is_done')->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil ditambahkan 🥰');
    }

    // Toggle Done / Undone
    public function toggleDone(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'is_done' => !$task->is_done,
        ]);

        return redirect()->route('dashboard');
    }

    // Tampilkan Form Edit Task
    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Simpan Perubahan Judul Task
    public function updateTitle(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil diedit 🥰');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard');
    }

    // Upcoming Tasks
    public function upcoming()
    {
        $tasks = Task::where('user_id', Auth::id())->where('due_date', '>=', today())->orderBy('due_date')->orderBy('is_done')->get()->groupBy('due_date');

        return view('tasks.upcoming', compact('tasks'));
    }
}
