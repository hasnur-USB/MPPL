<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('dashboard', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'kode_barang' => 'required|unique:pendaftarans,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Ambil semua data dari form
        $data = $request->all();

        // 3. Proses upload gambar (jika user mengunggah gambar)
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Buat nama file unik berdasarkan waktu saat ini
            $nama_file = time() . '_' . $file->getClientOriginalName();
            // Simpan gambar ke folder storage/app/public/barang
            $file->storeAs('public/barang', $nama_file);
            // Masukkan nama file ke array data untuk disimpan di database
            $data['gambar'] = $nama_file;
        }

        // 4. Simpan semua data ke database pendaftarans
        Pendaftaran::create($data);

        // 5. Alihkan kembali ke halaman pendaftaran (dashboard) dengan pesan sukses
        return redirect()->route('pendaftaran.index')->with('success', 'Data barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
