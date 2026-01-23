<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransaksiDetail;
use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
    protected $fillable = ['user_id', 'total_harga'];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
