<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id', 
        'buku_id', 
        'status', 
        'tanggal_pinjam', 
        'tanggal_kembali',
        'tanggal_nyata_kembali',
        'total_denda'
    ];

    protected $casts = [
        'tanggal_pinjam'        => 'date',
        'tanggal_kembali'       => 'date',
        'tanggal_nyata_kembali' => 'datetime',
        'total_denda'           => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function isTerlambat()
    {
        return $this->status === 'dipinjam' && Carbon::today()->gt($this->tanggal_kembali->startOfDay());
    }

    public function hitungHariTerlambat()
    {
        if ($this->isTerlambat()) {
            return $this->tanggal_kembali->startOfDay()->diffInDays(Carbon::today());
        }
        return 0;
    }

    public function hitungDenda()
    {
        $tarifDenda = 10000;

        if ($this->status === 'dipinjam') {
            $deadline = $this->tanggal_kembali->startOfDay();
            $hariIni  = Carbon::today();

            if ($hariIni->gt($deadline)) {
                return $deadline->diffInDays($hariIni) * $tarifDenda;
            }
            return 0;
        }

        if ($this->status === 'dikembalikan' && $this->tanggal_nyata_kembali) {
            $deadline = $this->tanggal_kembali->startOfDay();
            $kembali  = $this->tanggal_nyata_kembali->startOfDay();

            if ($kembali->gt($deadline)) {
                return $deadline->diffInDays($kembali) * $tarifDenda;
            }
        }

        return 0;
    }
}