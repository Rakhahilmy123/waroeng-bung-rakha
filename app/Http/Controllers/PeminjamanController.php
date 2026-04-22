<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{

public function index(Request $request)
{
    // Jika admin, tampilkan daftar transaksi dengan filter
    if (auth()->user()->role === 'admin') {
        $search = $request->input('search');
        $statusFilter = $request->input('status');

        $query = Peminjaman::with(['user', 'buku']);

        if ($statusFilter === 'dipinjam') {
            $query->where('status', 'dipinjam');
        } elseif ($statusFilter === 'dikembalikan') {
            $query->where('status', 'dikembalikan');
        } elseif ($statusFilter === 'terlambat') {
            $query->where('status', 'dipinjam')
                  ->whereDate('tanggal_kembali', '<', now());
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                       ->orWhere('nis', 'like', "%{$search}%");
                })->orWhereHas('buku', function($q3) use ($search) {
                    $q3->where('judul_buku', 'like', "%{$search}%");
                });
            });
        }

        $peminjamans = $query->orderByRaw("FIELD(status, 'dipinjam', 'dikembalikan') ASC")
                             ->orderBy('tanggal_kembali', 'ASC')
                             ->paginate(100);

        // ✅ Query terpisah agar akurat
        $totalTerlambat = Peminjaman::where('status', 'dipinjam')
            ->whereDate('tanggal_kembali', '<', now())
            ->count();

        $peminjamans->appends($request->only(['search', 'status']));

        return view('admin.transaksi.index', compact('peminjamans', 'totalTerlambat'));
    }

    // Untuk SISWA: tampilkan katalog buku dengan pencarian
    $search = $request->input('search');
    $bukus = Buku::when($search, function($query, $search) {
        return $query->where(function($q) use ($search) {
            $q->where('judul_buku', 'like', "%{$search}%")
              ->orWhere('penulis', 'like', "%{$search}%")
              ->orWhere('penerbit', 'like', "%{$search}%");
        });
    })->latest()->paginate(12);

    if ($search) {
        $bukus->appends(['search' => $search]);
    }

    // ✅ Tambahan untuk siswa
    $totalTerlambat = Peminjaman::where('user_id', auth()->id())
        ->where('status', 'dipinjam')
        ->whereDate('tanggal_kembali', '<', now())
        ->count();

    return view('peminjaman.index', compact('bukus', 'search', 'totalTerlambat'));
}
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'siswa')->where('is_verified_anggota', true)->get();
            $bukus = Buku::where('stok', '>', 0)->get();
            return view('admin.transaksi.create', compact('users', 'bukus'));
        }

        if (!Auth::user()->is_verified_anggota) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus menjadi anggota terverifikasi untuk meminjam buku.');
        }

        $bukus = Buku::where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('bukus'));
    }

public function store(Request $request)
{
    $rules = [
        'buku_id'         => 'required|exists:bukus,id',
        'tanggal_pinjam'  => 'nullable|date',
        'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
    ];

    if (Auth::user()->role === 'admin') {
        $rules['user_id'] = 'required|exists:users,id';
    }

    if (auth()->user()->role === 'siswa' && !auth()->user()->is_verified_anggota) {
        return redirect()->back()->with('error', 'Akun Anda belum diverifikasi oleh admin. Anda belum bisa meminjam buku.');
    }

// 🔒 CEK APAKAH ADA BUKU YANG TERLAMBAT Dikembalikan (BELUM DIKEMBALIKAN)
if (auth()->user()->role === 'siswa') {
    // Cek apakah ada peminjaman aktif (status 'dipinjam') yang sudah melewati deadline
    $adaTerlambat = Peminjaman::where('user_id', auth()->id())
        ->where('status', 'dipinjam')
        ->whereDate('tanggal_kembali', '<', now()) // deadline < hari ini
        ->exists();

    if ($adaTerlambat) {
        return redirect()->back()->with('error', 
            'Anda masih memiliki buku yang melewati batas waktu pengembalian. ' .
            'Segera kembalikan buku tersebut ke perpustakaan untuk dapat meminjam lagi.'
        );
    }

    // (Opsional) Jika ingin juga mengecek denda yang belum dibayar dari riwayat:
    $totalDenda = Peminjaman::where('user_id', auth()->id())
        ->where('status', 'dikembalikan')
        ->where('total_denda', '>', 0)
        ->sum('total_denda');

    if ($totalDenda > 0) {
        return redirect()->back()->with('error', 
            'Anda masih memiliki denda sebesar Rp ' . number_format($totalDenda, 0, ',', '.') . 
            '. Silakan lunasi denda terlebih dahulu ke petugas perpustakaan.'
        );
    }
}

    $request->validate($rules);
    $buku = Buku::findOrFail($request->buku_id);

    if ($buku->stok <= 0) {
        return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
    }

    $userId = Auth::user()->role === 'admin' ? $request->user_id : Auth::id();
    $tanggalPinjam = $request->tanggal_pinjam ?: now();
    $tanggalBatasKembali = $request->tanggal_kembali ?: Carbon::parse($tanggalPinjam)->addDays(7);

    Peminjaman::create([
        'user_id' => $userId,
        'buku_id' => $request->buku_id,
        'tanggal_pinjam' => $tanggalPinjam,
        'tanggal_kembali' => $tanggalBatasKembali,
        'status' => 'dipinjam',
        'total_denda' => 0
    ]);

    $buku->decrement('stok');
    $redirectRoute = Auth::user()->role === 'admin' ? 'admin.transaksi.index' : 'peminjaman.index';

    return redirect()->route($redirectRoute)->with('success', "Berhasil dipinjam!");
}

public function edit($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $users = User::where('role', 'siswa')->get();
    $bukus = Buku::all();

    return view('admin.transaksi.edit', compact('peminjaman', 'users', 'bukus'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'buku_id' => 'required|exists:bukus,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);
    
    // Opsional: Logika jika buku diganti, stok buku lama dikembalikan, stok buku baru dikurangi
    if ($peminjaman->buku_id != $request->buku_id) {
        $peminjaman->buku->increment('stok');
        Buku::findOrFail($request->buku_id)->decrement('stok');
    }

    $peminjaman->update($request->all());

    return redirect()->route('admin.transaksi.index')->with('success', 'Data transaksi berhasil diperbarui.');
}
    /**
     * PROSES PENGEMBALIAN & HITUNG DENDA FINAL
     */
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Ambil denda terakhir dari logic Model yang sudah kita buat tadi
        $dendaFinal = $peminjaman->hitungDenda();

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_nyata_kembali' => now(),
            'total_denda' => $dendaFinal // Simpan nominal denda ke DB
        ]);

        $peminjaman->buku->increment('stok');

        $pesan = 'Buku berhasil dikembalikan.';
        if($dendaFinal > 0) {
            $pesan .= ' Total denda yang harus dibayar: Rp ' . number_format($dendaFinal, 0, ',', '.');
        }

        return back()->with('success', $pesan);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }
        $peminjaman->delete();
        return back()->with('success', 'Data transaksi berhasil dihapus.');
    }

public function riwayat(Request $request)
{
    $userId = auth()->id();
    $query = Peminjaman::where('user_id', $userId)->with('buku');

    if ($request->tab == 'riwayat') {
        $query->where('status', 'dikembalikan');
    } else {
        $query->where('status', 'dipinjam');
    }

    $peminjamans = $query->latest()->paginate(100);

    // ✅ Hitung dari query baru, bukan dari hasil paginate
    $totalTerlambat = Peminjaman::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->whereDate('tanggal_kembali', '<', now())
        ->count();

    return view('peminjaman.riwayat', compact('peminjamans', 'totalTerlambat'));
}

public function lunasiDenda($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    if ($peminjaman->status === 'dikembalikan' && $peminjaman->total_denda > 0) {
        $peminjaman->update(['total_denda' => 0]);
        return back()->with('success', 'Denda telah dilunasi.');
    }
    return back()->with('error', 'Tidak dapat melunasi denda.');
}
}