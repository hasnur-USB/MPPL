<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('katalog.index')->with('error', 'Keranjang kosong!');
        }

        // Gunakan Transaction agar jika satu gagal, semua batal (aman)
        DB::transaction(function () use ($cart) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['harga'] * $item['jumlah'];
            }

            // 1. Simpan ke tabel orders
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_harga' => $total,
                'status' => 'pending',
            ]);

            // 2. Simpan detailnya ke order_items
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'barang_id' => $id,
                    'jumlah' => $item['jumlah'],
                    'harga_saat_beli' => $item['harga'],
                ]);

                // Opsional: Kurangi stok barang di sini jika mau
            }
        });

        // 3. Kosongkan keranjang
        session()->forget('cart');

        return view('checkout.success');
    }
}
