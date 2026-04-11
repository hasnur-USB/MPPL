<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang
     */
    public function index()
    {
        $cartItems = Cart::with('barang')->where('user_id', Auth::id())->get();

        $total = $cartItems->sum(function ($item) {
            return $item->qty * ($item->barang->harga ?? 0);
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Tambah barang ke keranjang (Database)
     */
    public function add(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Cek stok
        if ($barang->stok < 1) {
            return redirect()->back()->with('error', 'Stok barang sedang habis!');
        }

        // Tambah atau tambah jumlah kalau sudah ada
        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'barang_id' => $barang->id,
            ],
            [
                'qty' => \DB::raw('qty + 1'),
            ],
        );

        return redirect()
            ->route('cart.index')
            ->with('success', $barang->nama_barang . ' berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah barang di keranjang
     */
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);

        $qty = (int) $request->qty;

        if ($qty < 1) {
            return redirect()->back()->with('error', 'Jumlah minimal adalah 1');
        }

        // Cek stok
        if ($cartItem->barang->stok < $qty) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia!');
        }

        $cartItem->update(['qty' => $qty]);

        return redirect()->route('cart.index')->with('success', 'Jumlah barang berhasil diupdate');
    }

    /**
     * Hapus barang dari keranjang
     */
    public function remove($id)
    {
        Cart::where('user_id', Auth::id())->findOrFail($id)->delete();

        return redirect()->route('cart.index')->with('success', 'Barang berhasil dihapus dari keranjang');
    }
}
