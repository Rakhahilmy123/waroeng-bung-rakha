<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index() {
        $user = Auth::user();
        
        if ($user->role === 'operator') {
            $transaksis = Transaksi::with(['details.barang', 'user'])
            ->where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->latest()
            ->paginate(10);
        } elseif ($user->role === 'admin') {
            $transaksis = Transaksi::with(['details.barang', 'user'])
            ->when(request('tanggal_dari'), function($query) {
                $query->whereDate('created_at', '>=', request('tanggal_dari'));
            })
            ->when(request('tanggal_sampai'), function($query) {
                $query->whereDate('created_at', '<=', request('tanggal_sampai'));
            })
            ->latest()
            ->paginate(10);
        } else {
        $transaksis = Transaksi::with(['details.barang', 'user'])
            ->when(request('tanggal_dari'), function($query) {
                $query->whereDate('created_at', '>=', request('tanggal_dari'));
            })
            ->when(request('tanggal_sampai'), function($query) {
                $query->whereDate('created_at', '<=', request('tanggal_sampai'));
            })
            ->when(request('operator'), function($query) {
                $query->where('user_id', request('operator'));
            })
            ->latest()
            ->paginate(10);
        }

        $operators = [];
        if ($user->role === 'superadmin') {
            $operators = User::where('role', 'operator')->get();
        }

        return view('transaksi.index', compact('transaksis', 'operators'));
    }

    public function show($id) {
        $user = Auth::user();

        $transaksi = Transaksi::with(['details.barang', 'user'])->findOrFail($id);

        if ($user->role === 'operator' && $transaksi->user_id !== $user->id) {
            abort(403, 'Anda tidak punya akses ke transaksi ini');

        }
        return view('transaksi.show', compact('transaksi'));
    }

    public function create(Request $request)
    {
        $kategoris = Kategori::all();

        $query = Barang::query();

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->get();

        return view('transaksi.create', compact('barangs', 'kategoris'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array|min:1',
            'qty' => 'required|array',
        ]);

        $items = [];
        $total = 0;

        foreach ($request->barang_id as $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = isset($request->qty[$barangId]) ? (int) $request->qty[$barangId] : 1;

            // 🔒 Validasi qty
            if ($qty < 1) {
                return back()->withErrors('Jumlah minimal 1');
            }

            $hargaAsli = $barang->harga;    

            // ✅ ATURAN DISKON > 5
            $diskon = 0;
            if ($barang->diskon > 0 && $qty > 5) {
                $diskon = $barang->diskon;
            }

            $hargaFinal = $hargaAsli - ($hargaAsli * $diskon / 100);
            $subtotal = $hargaFinal * $qty;

            $items[] = [
                'id' => $barang->id,
                'nama' => $barang->nama_barang,
                'harga_asli' => $hargaAsli,
                'diskon' => $diskon,
                'harga_final' => $hargaFinal,
                'qty' => $qty,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        // ✅ DISKON BERDASARKAN TOTAL
$diskonTotal = 0;

if ($total >= 100000) {
    $diskonTotal = 10;
} elseif ($total >= 50000) {
    $diskonTotal = 5;
}

// ✅ DISKON WAKTU
$diskonWaktu = 0;
$now = Carbon::now();

if ($now->isWeekend()) {
    $diskonWaktu = 5;
}

if ($now->hour >= 18 && $now->hour <= 21) {
    $diskonWaktu = max($diskonWaktu, 5);
}

$totalDiskon = min($diskonTotal + $diskonWaktu, 20);

$potongan = $total * $totalDiskon / 100;
$totalAkhir = $total - $potongan;


    return view('transaksi.preview', compact(
        'items',
        'total',
        'totalDiskon',
        'potongan',
        'totalAkhir'
    ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'qty' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'total_harga' => 0,
                'diskon' => 0,
            ]);

            foreach ($request->barang_id as $barangId) {
                $barang = Barang::lockForUpdate()->findOrFail($barangId);
                $qty = isset($request->qty[$barangId]) ? (int) $request->qty[$barangId] : 1;


                if ($qty > $barang->stok) {
                    throw new \Exception("Stok tidak cukup");
                }

                $hargaAsli = $barang->harga;

                // ✅ HITUNG ULANG DISKON (AMAN)
                $diskon = 0;
                if ($barang->diskon > 0 && $qty > 5) {
                    $diskon = $barang->diskon;
                }

                $hargaFinal = $hargaAsli - ($hargaAsli * $diskon / 100);
                $subtotal = $hargaFinal * $qty;

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'qty' => $qty,
                    'harga' => $hargaFinal,
                    'diskon' => $diskon,
                    'subtotal' => $subtotal,
                ]);

                $barang->decrement('stok', $qty);
                $total += $subtotal;
            }

            $diskonTotal = 0;
            if ($total >= 100000) {
                $diskonTotal = 10;
            } elseif ($total >= 50000) {
                $diskonTotal = 5;
            }

            $diskonwaktu = 0;
            $now = Carbon::now();

            if ($now->isWeekend()) {
                $diskonwaktu = 5;
            } 
            
            if ($now->hour >= 18 && $now->hour <= 21) {
                $diskonwaktu = max($diskonwaktu, 5);
            }

            $totalDiskon = $diskonTotal + $diskonwaktu;

            $totalDiskon = min($totalDiskon, 20);
            $potongan = $total * $totalDiskon / 100;
            $totalAkhir = $total - $potongan;

            $transaksi->update(['diskon' => $totalDiskon, 'total_harga' => $totalAkhir]);
        });

        return redirect()
            ->route('transaksi.create')
            ->with('success', 'Transaksi berhasil');
    }
}