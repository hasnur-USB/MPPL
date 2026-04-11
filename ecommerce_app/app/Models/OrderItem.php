<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'barang_id', 'jumlah', 'harga_saat_beli'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
