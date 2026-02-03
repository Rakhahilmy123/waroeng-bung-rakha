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
    $user = auth()->user();
    
    if (in_array($user->role, ['admin', 'superadmin'])) {
        // Data untuk Admin & Superadmin
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalOmzet = Transaksi::sum('total_harga');
        
        return view('dashboard', compact('totalBarang', 'totalTransaksi', 'totalOmzet'));
        
    } elseif ($user->role === 'operator') {
        // Data untuk Operator (hanya transaksi mereka sendiri)
        $transaksiHariIni = Transaksi::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();
            
        $transaksiBulanIni = Transaksi::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $omzetHariIni = Transaksi::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->sum('total_harga');
        
        return view('dashboard', compact('transaksiHariIni', 'transaksiBulanIni', 'omzetHariIni'));
    }
    
    return view('dashboard');
}
}
