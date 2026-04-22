<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * READ (R): Menampilkan daftar siswa
     * FIX: Ubah 'asc' -> 'desc' agar yang sudah terverifikasi muncul di atas
     */
    public function index(Request $request)
    {
               $search = $request->input('search');
        $statusFilter = $request->input('status'); // 'verified', 'unverified', atau null

        $query = User::where('role', 'siswa');

        // Filter status verifikasi
        if ($statusFilter === 'verified') {
            $query->where('is_verified_anggota', true);
        } elseif ($statusFilter === 'unverified') {
            $query->where('is_verified_anggota', false);
        }

        // Pencarian teks (nama, nis, email, nomor_anggota)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_anggota', 'like', "%{$search}%");
            });
        }

        $siswas = $query->orderBy('is_verified_anggota', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        // Tambahkan parameter query ke pagination
        $siswas->appends($request->only(['search', 'status']));

        return view('admin.anggota.index', compact('siswas'));
    }

    /**
     * CREATE (C): Menampilkan form tambah anggota baru
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * STORE (C): Menyimpan data anggota baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nis'      => 'nullable|string|max:20',
            'telepon'  => 'nullable|string|max:15',
            'alamat'   => 'nullable|string',
        ]);

        User::create([
            'name'                => $request->name,
            'email'               => $request->email,
            'nis'                 => $request->nis,
            'password'            => Hash::make($request->password),
            'role'                => 'siswa',
            'telepon'             => $request->telepon,
            'alamat'              => $request->alamat,
            'is_approved'         => true,
            'is_verified_anggota' => false,
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    /**
     * EDIT (U): Menampilkan form edit data anggota
     */
    public function edit(User $user)
    {
        return view('admin.anggota.edit', compact('user'));
    }

    /**
     * UPDATE (U): Memperbarui data anggota
     * Kolom 'is_verified_anggota' dan 'nomor_anggota' TIDAK disentuh
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nis'     => 'nullable|string|max:20',
            'telepon' => 'nullable|string|max:15',
            'alamat'  => 'nullable|string',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'nis'     => $request->nis,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', "Data {$user->name} berhasil diperbarui.");
    }

    /**
     * DESTROY (D): Menghapus data anggota
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', "Anggota telah dihapus.");
    }

    /**
     * Verifikasi anggota siswa
     */
    public function verifikasi(User $user)
    {
        if ($user->role !== 'siswa') {
            return back()->with('error', 'Hanya siswa yang bisa diverifikasi.');
        }

        $user->update([
            'is_verified_anggota' => true,
            'nomor_anggota'       => 'LIB-' . now()->format('Ymd') . '-' . $user->id,
        ]);

        return back()->with('success', "Siswa {$user->name} berhasil diverifikasi.");
    }

    /**
     * Batalkan Verifikasi
     */
    public function batalkanVerifikasi(User $user)
    {
        $user->update([
            'is_verified_anggota' => false,
            'nomor_anggota'       => null,
        ]);

        return back()->with('success', "Status keanggotaan {$user->name} dicabut.");
    }
}