<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('barang')->where('user_id', Auth::id())->get();

        $total = $cartItems->sum(function ($item) {
            return $item->qty * $item->barang->harga;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'qty' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek stok
        if ($barang->stok < $request->qty) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        // Tambah atau update cart
        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'barang_id' => $request->barang_id,
            ],
            [
                'qty' => \DB::raw('qty + ' . $request->qty),
            ],
        );

        return redirect()->route('cart.index')->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);

        if ($request->qty < 1) {
            return redirect()->back()->with('error', 'Jumlah minimal 1');
        }

        $cartItem->update(['qty' => $request->qty]);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diupdate');
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())->findOrFail($id)->delete();

        return redirect()->route('cart.index')->with('success', 'Barang dihapus dari keranjang');
    }
}
