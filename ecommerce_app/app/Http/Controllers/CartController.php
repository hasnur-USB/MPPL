<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Menambah barang ke keranjang
    public function add($id)
    {
        $barang = Barang::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                'nama_barang' => $barang->nama_barang,
                'harga' => $barang->harga,
                'jumlah' => 1,
                // TAMBAHKAN BARIS INI AGAR GAMBAR IKUT TERSIMPAN:
                'gambar' => $barang->gambar,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // Menghapus satu item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Barang dihapus dari keranjang.');
    }
}
