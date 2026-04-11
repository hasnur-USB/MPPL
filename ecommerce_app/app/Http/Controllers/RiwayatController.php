<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil pesanan yang hanya milik user yang sedang login
        $orders = Order::with('items.barang')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('riwayat.index', compact('orders'));
    }
}