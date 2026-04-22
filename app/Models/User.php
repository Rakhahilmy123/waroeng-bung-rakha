<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'password',
        'role', // superadmin, admin, operator, siswa
        'is_approved', // Untuk login (Validasi Login di Flowchart)
        'is_verified_anggota', // Untuk pinjam buku (Kotak Anggota di Flowchart)
        'nomor_anggota',
        'alamat',
        'telepon'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_approved' => 'boolean',
        'is_verified_anggota' => 'boolean', // Pastikan ini ada
    ];

    /**
     * Scope untuk melihat user yang butuh approval login
     * (Bisa operator atau siswa yang baru register)
     */
    public function scopePendingApproval($query)
    {
        return $query->where('is_approved', false);
    }

    /**
     * Scope khusus untuk Admin melihat Siswa yang sudah login 
     * tapi belum resmi jadi Anggota (butuh validasi kartu anggota)
     */
    public function scopePendingAnggota($query)
    {
        return $query->where('role', 'siswa')
                     ->where('is_approved', true)
                     ->where('is_verified_anggota', false);
    }
}