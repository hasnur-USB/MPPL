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

        // Ambil semua item di keranjang dari database
        $cartItems = Cart::with('barang')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        DB::transaction(function () use ($cartItems, $userId) {
            $total = 0;

            // 1. Buat Order baru
            $order = Order::create([
                'user_id' => $userId,
                'total_harga' => 0, // akan diupdate nanti
                'status' => 'pending',
            ]);

            // 2. Simpan setiap item ke OrderItem + hitung total
            foreach ($cartItems as $cartItem) {
                $subtotal = $cartItem->qty * $cartItem->barang->harga;

                OrderItem::create([
                    'order_id' => $order->id,
                    'barang_id' => $cartItem->barang_id,
                    'qty' => $cartItem->qty,
                    'harga_saat_beli' => $cartItem->barang->harga,
                ]);

                $total += $subtotal;

                // Kurangi stok barang
                $cartItem->barang->decrement('stok', $cartItem->qty);
            }

            // Update total harga di order
            $order->update(['total_harga' => $total]);
        });

        // 3. Kosongkan keranjang (hapus semua cart item user)
        Cart::where('user_id', $userId)->delete();

        // 4. Redirect ke halaman sukses atau riwayat
        return redirect()->route('riwayat.index')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
    }
}
