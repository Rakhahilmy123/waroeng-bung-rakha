<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk urusan hapus file

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $bukus = Buku::with('kategori')->latest()->get();
        $search = $request->input('search');
        $bukus = Buku::when($search, function($query, $search) {
        return $query->where(function($q) use ($search) {
            $q->where('judul_buku', 'like', "%{$search}%")
            ->orWhere('penulis', 'like', "%{$search}%")
            ->orWhere('penerbit', 'like', "%{$search}%");
        });
    })->latest()->paginate(100);
    if ($search) {
        $bukus->appends(['search' => $search]);
    }
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    /**
     * Menyimpan data buku baru + Upload Gambar
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'  => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'penulis'     => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok'        => 'required|integer|min:0',
        ]);

        $nama_gambar = null;

        // Logika Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/', $nama_gambar); // Simpan ke storage/app/public/buku
        }

        Buku::create([
            'judul_buku'  => $request->judul_buku,
            'kategori_id' => $request->kategori_id,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'gambar'      => $nama_gambar, // Simpan nama filenya ke database
            'stok'        => $request->stok,
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan ke koleksi.');
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoris'));
    }

    /**
     * Update data buku + Ganti Gambar
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul_buku'  => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'penulis'     => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok'        => 'required|integer|min:0',
        ]);

        $nama_gambar = $buku->gambar; // Default pakai gambar lama

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar) {
                Storage::delete('public/' . $buku->gambar);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $nama_gambar = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/', $nama_gambar);
        }

        $buku->update([
            'judul_buku'  => $request->judul_buku,
            'kategori_id' => $request->kategori_id,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'gambar'      => $nama_gambar,
            'stok'        => $request->stok,
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Hapus buku + Hapus filenya dari storage
     */
    public function destroy(Buku $buku)
    {
        // Hapus file fisik gambar jika ada
        if ($buku->gambar) {
            Storage::delete('public/' . $buku->gambar);
        }

        $buku->delete();
        return redirect()->route('buku.index')
            ->with('success', 'Buku telah dihapus dari sistem.');
    }
}