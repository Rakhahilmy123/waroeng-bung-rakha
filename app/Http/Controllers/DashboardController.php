<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'superadmin'])) {
            $totalBuku     = Buku::count();
            $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();

            // FIX: Ganti $pendingAnggota -> $totalAnggota
            // Dashboard blade menggunakan {{ $totalAnggota ?? 0 }}
            // bukan $pendingAnggota, sehingga stat selalu tampil 0
            $totalAnggota = User::where('role', 'siswa')
                ->where('is_verified_anggota', true) // hanya yang sudah terverifikasi
                ->count();

            // Bonus: tetap kirim pendingAnggota jika dipakai di tempat lain
            $pendingAnggota = User::where('role', 'siswa')
                ->where('is_verified_anggota', false)
                ->count();

            return view('dashboard', compact(
                'totalBuku',
                'totalDipinjam',
                'totalAnggota',   // ← ini yang hilang sebelumnya
                'pendingAnggota'
            ));
        }

        if ($user->role === 'siswa') {
            $myBorrowedBooks = Peminjaman::where('user_id', $user->id)
                ->where('status', 'dipinjam')
                ->count();

            return view('dashboard', compact('myBorrowedBooks'));
        }

        return view('dashboard');
    }
}