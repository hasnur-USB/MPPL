<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminBarangController;
use App\Http\Controllers\RiwayatController;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// PENGARAH LALU LINTAS (TRAFFIC CONTROLLER)
// ==========================================
// Menggantikan dashboard bawaan Breeze agar membagi rute berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('katalog.index');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// RUTE UNTUK CUSTOMER
// ==========================================
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Halaman Katalog Utama
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

    // Rute Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Rute Checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // Rute Riwayat Pesanan
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

// ==========================================
// RUTE UNTUK ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Halaman Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Rute CRUD untuk mengelola barang
        Route::resource('barang', AdminBarangController::class);

        // Rute untuk mengelola pesanan (SUDAH DIPERBAIKI)
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

require __DIR__ . '/auth.php';
