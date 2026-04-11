<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = ['user_id', 'barang_id', 'qty'];

    protected $casts = [
        'qty' => 'integer',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
