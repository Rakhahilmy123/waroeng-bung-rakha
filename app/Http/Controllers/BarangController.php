<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung harga_diskon
        $harga = $request->harga;
        $diskon = $request->diskon ?? 0;
        $hargaDiskon = $harga - ($harga * $diskon / 100);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $harga,
            'stok' => $request->stok,
            'diskon' => $diskon,
            'harga_diskon' => $hargaDiskon,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung harga_diskon
        $harga = $request->harga;
        $diskon = $request->diskon ?? 0;
        $hargaDiskon = $harga - ($harga * $diskon / 100);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $harga,
            'stok' => $request->stok,
            'diskon' => $diskon,
            'harga_diskon' => $hargaDiskon,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}