<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Pesanan Masuk (status pending)
        $pendingOrders = Order::where('status', 'pending')->count();

        // 2. Pendapatan Bulan Ini
        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        // 3. Barang Aktif (stok > 0)
        $activeProducts = Barang::where('stok', '>', 0)->count();

        // 4. Total Pesanan Keseluruhan
        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'pendingOrders',
            'monthlyRevenue',
            'activeProducts',
            'totalOrders'
        ));
    }
}