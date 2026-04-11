<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar semua pesanan
    public function index()
    {
        // Ambil order beserta data user, urutkan dari yang paling baru
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan (barang apa saja yang dibeli)
    public function show(Order $order)
    {
        // Ambil detail item dan relasi barangnya
        $order->load('items.barang', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // Mengubah status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
