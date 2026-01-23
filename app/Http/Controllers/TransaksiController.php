<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'exists:barangs,id',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
        ], [
            'barang_id.required' => 'Pilih minimal 1 barang',
            'barang_id.min' => 'Pilih minimal 1 barang',
            'qty.*.min' => 'Jumlah minimal 1',
        ]);

        $items = [];
        $total = 0;

        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = (int) $request->qty[$index];

            // Validasi stok
            if ($qty > $barang->stok) {
                return back()->withErrors([
                    'qty' => "Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok}"
                ])->withInput();
            }

            // Hitung harga dengan diskon jika ada
            $harga = $barang->harga;
            $diskon = 0;
            
            if ($barang->diskon > 0 && $qty > 5) {
                $diskon = $barang->diskon;
            }

            $hargaDiskon = $harga - ($harga * $diskon / 100);
            $subtotal = $hargaDiskon * $qty;

            $items[] = [
                'id' => $barang->id,
                'nama' => $barang->nama_barang,
                'harga_asli' => $harga,
                'diskon' => $diskon,
                'harga_final' => $hargaDiskon,
                'qty' => $qty,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('transaksi.preview', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;

            $transaksi = Transaksi::create([
                'user_id' => Auth()->id(),
                'total_harga' => 0,
            ]);

                    foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::lockForUpdate()->findOrFail($barangId);
            $qty = (int) $request->qty[$index];

            if ($qty > $barang->stok) {
                throw new \Exception(
                    "Stok {$barang->nama_barang} tidak mencukupi!"
                );
            }

            $diskon = ($barang->diskon > 0 && $qty > 5)
                ? $barang->diskon
                : 0;

            $harga = $barang->harga;
            $hargaDiskon = $harga - ($harga * $diskon / 100);
            $subtotal = $hargaDiskon * $qty;

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $barangId,
                'qty' => $qty,
                'harga' => $hargaDiskon,
                'diskon' => $diskon,
                'subtotal' => $subtotal,
            ]);

            $barang->decrement('stok', $qty);
            $total += $subtotal;
        }

        $transaksi->update(['total_harga' => $total]);
        });

        return redirect()->route('transaksi.create')->with('success', 'Transaksi berhasil');
    }

}
