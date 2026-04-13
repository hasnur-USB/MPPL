<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// ==================== ROUTE UMUM ====================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==================== ROUTE PESERTA ====================
Route::get('/daftar', [RegistrationController::class, 'create'])->name('daftar');
Route::post('/daftar', [RegistrationController::class, 'store']);

Route::get('/status', [RegistrationController::class, 'status'])->name('status');
Route::post('/status', [RegistrationController::class, 'checkStatus']);

// ==================== ROUTE ADMIN (LOGIN BREEZE) ====================
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/approve/{id}', [AdminController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [AdminController::class, 'reject'])->name('reject');
        Route::delete('/registration/{id}', [AdminController::class, 'destroy'])->name('delete');
    });

// ==================== ROUTE AUTH DARI BREEZE ====================
require __DIR__ . '/auth.php';
