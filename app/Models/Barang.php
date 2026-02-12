<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'diskon',
        'kategori_id',
    ];

    public function getHargaDiskonAttribute()
    {
        return $this->harga - ($this->harga * $this->diskon / 100);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
