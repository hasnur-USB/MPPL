<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();

        $cartItems = Cart::with('barang')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        DB::transaction(function () use ($cartItems, $userId) {
            $total = 0;

            $order = Order::create([
                'user_id' => $userId,
                'total_harga' => 0,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $cartItem) {
                $subtotal = $cartItem->qty * ($cartItem->barang->harga ?? 0);

                OrderItem::create([
                    'order_id' => $order->id,
                    'barang_id' => $cartItem->barang_id,
                    'jumlah' => $cartItem->qty, // ← ini yang diperbaiki
                    'harga_saat_beli' => $cartItem->barang->harga,
                ]);

                $total += $subtotal;

                // Kurangi stok barang
                if ($cartItem->barang) {
                    $cartItem->barang->decrement('stok', $cartItem->qty);
                }
            }

            $order->update(['total_harga' => $total]);
        });

        // Kosongkan keranjang
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('riwayat.index')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
    }
}
