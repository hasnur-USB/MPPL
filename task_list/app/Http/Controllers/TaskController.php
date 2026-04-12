<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //TODAY
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->whereNull('due_date') 
            ->orderBy('is_done')
            ->orderBy('created_at', 'desc')
            ->get();

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
            'due_date' => null, 
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil ditambahkan 🥰');
    }

    // TOGGLE DONE
    public function toggleDone(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['is_done' => !$task->is_done]);

        return redirect()->back();
    }

    // EDIT TITLE
    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function updateTitle(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['title' => 'required|string|max:255']);

        $task->update(['title' => $request->title]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil diedit 🥰');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        $task->delete();
        return redirect()->back();
    }

    // UPCOMING:
    public function upcoming()
    {
        $tasks = Task::where('user_id', Auth::id())->whereNotNull('due_date')->orderBy('due_date')->orderBy('is_done')->get()->groupBy('due_date');

        return view('tasks.upcoming', compact('tasks'));
    }

    // Store dari Upcoming 
    public function storeScheduled(Request $request)
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

        return redirect()->route('upcoming')->with('success', 'Task terjadwal berhasil ditambahkan 📅');
    }
}
