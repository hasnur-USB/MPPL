<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'nama', 'nim', 'email', 'jurusan', 'universitas', 'alasan', 'no_hp', 'ktm_path', 'status', 'catatan_admin'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
