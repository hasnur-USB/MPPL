<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DiaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // Today Routes
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Upcoming Routes
    Route::get('/upcoming', [TaskController::class, 'upcoming'])->name('upcoming');
    Route::post('/tasks/scheduled', [TaskController::class, 'storeScheduled'])->name('tasks.storeScheduled');

    // Common Routes
    Route::patch('/tasks/{task}', [TaskController::class, 'toggleDone'])->name('tasks.toggle');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'updateTitle'])->name('tasks.updateTitle');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Diary Routes
    Route::get('/diary', [DiaryController::class, 'index'])->name('diary.index');
    Route::post('/diary', [DiaryController::class, 'store'])->name('diary.store');
});

// Profile Breeze (tetap dipertahankan)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
