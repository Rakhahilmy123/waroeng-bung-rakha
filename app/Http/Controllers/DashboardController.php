<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalOmzet = Transaksi::sum('total_harga');

        return view('dashboard', compact(
            'totalBarang',
            'totalTransaksi',
            'totalOmzet'
        ));
    }
}
