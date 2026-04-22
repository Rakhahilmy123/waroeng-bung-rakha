<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Ini adalah proses "Validasi Login" di flowchart
        $request->authenticate();

        $request->session()->regenerate();

        // ========== TAMBAHKAN KODE UNTUK SPLASH SCREEN ==========
        // Ambil data user yang baru login
        $user = Auth::user();
        
        // Simpan session untuk menampilkan splash screen (gunakan session() helper)
        session()->flash('show_splash', true);
        
        // Sesuaikan pesan berdasarkan role user
        if ($user->role === 'admin') {
            $splashMessage = "Selamat datang, {$user->name}!";
        } elseif ($user->role === 'siswa') {
            $splashMessage = "Halo {$user->name}, selamat membaca!";
        } else {
            $splashMessage = "Selamat datang, {$user->name}!";
        }
        
        session()->flash('splash_message', $splashMessage);
        
        // Optional: Simpan juga role untuk keperluan lain
        session()->flash('user_role', $user->role);
        // ========== END TAMBAHAN KODE SPLASH SCREEN ==========

        // Berhasil divalidasi (True) -> Masuk Dashboard (Siswa atau Admin)
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}