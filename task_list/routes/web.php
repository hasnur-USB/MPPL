<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard = Today's Tasks
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // Task Routes
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');           // Tambah task
    Route::patch('/tasks/{task}', [TaskController::class, 'toggleDone'])->name('tasks.toggle'); // Centang done/undone

    // Edit Task (Form + Simpan)
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'updateTitle'])->name('tasks.updateTitle');

    // Delete Task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Upcoming Page
    Route::get('/upcoming', [TaskController::class, 'upcoming'])->name('upcoming');

});

// Profile Breeze (tetap dipertahankan)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';