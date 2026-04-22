<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'nis' => ['required', 'string', 'unique:users,nis'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'telepon' => ['required', 'string', 'max:15'],
        'alamat' => ['required', 'string'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nis' => $request->nis,
        'password' => Hash::make($request->password),
        'role' => 'siswa', 
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'is_approved' => true, // Agar bisa divalidasi saat login
        'is_verified_anggota' => false // Belum diverifikasi fisik
    ]);

    event(new Registered($user));

    // JANGAN Langsung login (Sesuai Flowchart: Balik ke Input Username/Password)
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
}
}