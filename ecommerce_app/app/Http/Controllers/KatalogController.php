<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        // Mengambil semua barang dari database
        $barangs = Barang::all();

        // Kirim data barang ke view
        return view('katalog.index', compact('barangs'));
    }
}
