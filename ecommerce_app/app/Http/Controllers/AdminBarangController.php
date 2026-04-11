<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    // 1. Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    // 2. Menampilkan form tambah barang
    public function create()
    {
        return view('admin.barang.create');
    }

    // 3. Menyimpan data barang baru ke database
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk, termasuk memastikan gambar sesuai format
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil semua data teks dari inputan
        $input = $request->all();

        // 3. Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder: storage/app/public/barangs
            // Dan simpan nama foldernya ('barangs/namafile.jpg') ke variabel $input['gambar']
            $path = $request->file('gambar')->store('barangs', 'public');
            $input['gambar'] = $path;
        }

        // 4. Simpan ke database
        Barang::create($input);

        // 5. Kembali ke halaman daftar barang dengan pesan sukses
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan beserta gambarnya!');
    }

    // 4. Menampilkan detail barang (opsional, bisa dilewati jika tidak butuh)
    public function show(string $id)
    {
        //
    }

    // 5. Menampilkan form edit barang
    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    // 6. Memperbarui data barang di database
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        // Cek apakah Admin mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama dari folder (jika barang tersebut punya gambar)
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // 2. Simpan gambar baru
            $path = $request->file('gambar')->store('barangs', 'public');
            $input['gambar'] = $path;
        }

        // Update data di database
        $barang->update($input);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    // 7. Menghapus data barang
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        // 1. Hapus file gambar dari folder (jika barang tersebut punya gambar)
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        // 2. Hapus data barang dari database
        $barang->delete();

        // 3. Kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.barang.index')->with('success', 'Barang beserta gambarnya berhasil dihapus!');
    }
}
