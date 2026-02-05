<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $pendingOperators = User::pendingApproval()->count(); // ✅ HITUNG PENDING
        return view('users.index', compact('users', 'pendingOperators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:superadmin,admin,operator'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_approved' => true // ✅ USER YANG DIBUAT SUPERADMIN LANGSUNG APPROVED
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,admin,operator'
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    // ✅ TAMBAHKAN METHOD BARU UNTUK APPROVAL

    /**
     * Show pending operators for approval
     */
    public function pending()
    {
        $pendingUsers = User::pendingApproval()->latest()->get();
        return view('users.pending', compact('pendingUsers'));
    }

    /**
     * Approve an operator
     */
    public function approve(User $user)
    {
        if ($user->role !== 'operator') {
            return back()->with('error', 'Hanya operator yang bisa diapprove');
        }

        $user->update(['is_approved' => true]);

        return back()->with('success', "Operator {$user->name} berhasil disetujui");
    }


    public function reject(User $user)
    {
        if ($user->role !== 'operator') {
            return back()->with('error', 'Hanya operator yang bisa ditolak');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Operator {$userName} berhasil ditolak dan dihapus");
    }

}