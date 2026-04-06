<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi data
    protected $fillable = ['gambar', 'kode_barang', 'nama_barang', 'kategori', 'satuan', 'stok', 'harga'];
}
