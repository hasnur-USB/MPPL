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
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'due_date' => today(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil ditambahkan 🥰');
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'is_done' => !$task->is_done,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard');
    }
}
