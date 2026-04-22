<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('welcome'); });
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| 2. AUTH ROUTES (Semua Role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    /**
     * FITUR SISWA
     */
    Route::middleware('role:siswa')->group(function () {
        // Katalog Buku (daftar buku beserta cover, dll)
        Route::get('/katalog-buku', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        
        // Riwayat peminjaman siswa (aktif & selesai)
        Route::get('/riwayat-saya', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
        Route::post('/pinjam-buku', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });
});

/*
|--------------------------------------------------------------------------
| 3. ADMIN ONLY ROUTES (Sesuai Flowchart CRUD Kaprog)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Manajemen Transaksi/Sirkulasi
    Route::get('/admin/transaksi', [PeminjamanController::class, 'index'])->name('admin.transaksi.index');
    Route::resource('admin-transaksi', PeminjamanController::class)->except(['index', 'show'])->names([
        'create'  => 'admin.transaksi.create',
        'store'   => 'admin.transaksi.store',
        'edit'    => 'admin.transaksi.edit',
        'update'  => 'admin.transaksi.update',
        'destroy' => 'admin.transaksi.destroy',
    ]);
    Route::patch('/admin/transaksi/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    
    // 🔹 Rute untuk lunasi denda (setelah siswa bayar tunai)
    Route::patch('/admin/transaksi/{id}/lunasi', [PeminjamanController::class, 'lunasiDenda'])->name('admin.transaksi.lunasi');

    // Manajemen Anggota (Satu Pintu)
    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'user'])->names([
        'index'   => 'admin.anggota.index',
        'create'  => 'admin.anggota.create',
        'store'   => 'admin.anggota.store',
        'edit'    => 'admin.anggota.edit',
        'update'  => 'admin.anggota.update',
        'destroy' => 'admin.anggota.destroy',
    ]);
    
    // Rute Khusus Verifikasi
    Route::patch('/anggota/{user}/verifikasi', [AnggotaController::class, 'verifikasi'])->name('admin.anggota.verifikasi');
    Route::patch('/anggota/{user}/batalkan', [AnggotaController::class, 'batalkanVerifikasi'])->name('admin.anggota.batalkan');

    // Kelola Buku & Kategori
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
    
    // Manajemen User (Kaprog)
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
});

require __DIR__.'/auth.php';

Route::post('/clear-splash-session', function () {
    session()->forget('show_splash');
    return response()->json(['success' => true]);
})->middleware('auth')->name('clear-splash-session');