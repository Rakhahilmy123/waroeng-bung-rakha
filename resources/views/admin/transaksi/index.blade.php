<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Transaksi peminjaman & Pengembalian</h2>
            </div>
            <a href="{{ route('admin.transaksi.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pinjaman Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Alert Terlambat --}}
            @if($totalTerlambat > 0)
            <div class="flex items-start gap-3 bg-white border border-red-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-red-600 uppercase tracking-[0.2em] mb-0.5">Perhatian Admin</p>
                    <p class="text-sm font-semibold text-red-700">
                        Ada <span class="font-black">{{ $totalTerlambat }} siswa</span> yang terdeteksi telat mengembalikan buku.
                    </p>
                </div>
            </div>
            @endif

            {{-- Filter dan Pencarian --}}
<div class="mb-6">
    <form method="GET" action="{{ route('admin.transaksi.index') }}" class="flex flex-col sm:flex-row gap-3">
        <!-- Search Input -->
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari nama siswa, NIS, atau judul buku..." 
                   class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
        </div>

        <!-- Filter Status -->
        <div class="w-full sm:w-48">
            <select name="status" class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl text-sm font-medium">
                <option value="">Semua Status</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Masih Dipinjam</option>
                <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Sudah Selesai</option>
                <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            </select>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-2">
            <button type="submit" 
                    class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-slate-700 transition-all duration-200 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Filter
            </button>
            
            @if(request('search') || request('status'))
                <a href="{{ route('admin.transaksi.index') }}" 
                   class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-slate-100 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
            @endif
        </div>
    </form>
    
    @if(request('search') || request('status'))
        <div class="mt-3 text-xs text-slate-500">
            Menampilkan hasil 
            @if(request('search')) untuk keyword <strong>"{{ request('search') }}"</strong> @endif
            @if(request('status')) dengan status <strong>{{ request('status') == 'dipinjam' ? 'Masih Dipinjam' : (request('status') == 'dikembalikan' ? 'Sudah Selesai' : 'Terlambat') }}</strong> @endif
            (Total {{ $peminjamans->total() }} transaksi)
        </div>
    @endif
</div>

            {{-- Table Card --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Manajemen Transaksi</p>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Card Header --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <span class="text-sm font-black text-slate-900">Transaksi Aktif</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-wider">
                            {{ $peminjamans->total() }} Data
                        </span>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/70">
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Siswa / Peminjam</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Info Buku</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Periode / Deadline</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Status</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Denda</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($peminjamans as $p)
                                @php
                                    $isTelat = $p->status === 'dipinjam' && \Carbon\Carbon::parse($p->tanggal_kembali)->lt(\Carbon\Carbon::today());
                                    $dendaSaatIni = $p->hitungDenda();
                                @endphp
                                <tr class="hover:bg-slate-50 transition-colors duration-150 group {{ $isTelat ? 'border-l-2 border-l-red-400' : '' }}">

                                    {{-- Siswa --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-slate-900 flex items-center justify-center shrink-0 transition-colors duration-200 font-black text-sm text-slate-500 group-hover:text-white">
                                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $p->user->name }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">NIS: {{ $p->user->nis ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Info Buku --}}
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-900 leading-tight max-w-[200px] truncate">{{ $p->buku->judul_buku }}</p>
                                    </td>

                                    {{-- Periode --}}
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex flex-col items-center gap-0.5">
                                            <span class="text-xs font-bold text-slate-900">
                                                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}
                                            </span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-wide">
                                                {{ $p->status === 'dipinjam' ? 's/d Deadline' : 'Dikembalikan' }}
                                            </span>
                                            <span class="text-xs font-bold
                                                @if($p->status === 'dipinjam')
                                                    {{ $isTelat ? 'text-red-500' : 'text-slate-600' }}
                                                @else
                                                    text-emerald-600
                                                @endif">
                                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($p->status === 'dipinjam')
                                            @if($isTelat)
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-red-700 bg-red-100 px-2.5 py-1 rounded-lg uppercase tracking-wide animate-pulse">
                                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                                    Terlambat
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-amber-700 bg-amber-100 px-2.5 py-1 rounded-lg uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                                    Dipinjam
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-lg uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                Selesai
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Denda --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($p->status === 'dikembalikan')
                                            <span class="text-xs font-bold {{ $p->total_denda > 0 ? 'text-red-500' : 'text-slate-400' }}">
                                                Rp {{ number_format($p->total_denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            @if($dendaSaatIni > 0)
                                                <div>
                                                    <p class="text-xs font-black text-red-600">Rp {{ number_format($dendaSaatIni, 0, ',', '.') }}</p>
                                                    <p class="text-[9px] font-bold text-red-400 uppercase tracking-wide mt-0.5">Berjalan</p>
                                                </div>
                                            @else
                                                <span class="text-[10px] text-slate-300 font-medium">—</span>
                                            @endif
                                        @endif
                                    </td>

                                   {{-- Aksi --}}
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($p->status === 'dipinjam')
                                                {{-- Tombol Terima (pengembalian) --}}
                                                <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            onclick="return confirm('Konfirmasi terima buku? Pastikan denda sudah dibayar jika ada.')"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-900 text-white rounded-lg text-[10px] font-bold hover:bg-slate-700 transition-all duration-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Terima
                                                    </button>
                                                </form>

                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.transaksi.edit', $p->id) }}"
                                                class="p-1.5 bg-slate-100 text-slate-500 hover:bg-slate-900 hover:text-white rounded-lg transition-all duration-200 border border-slate-200 hover:border-slate-900">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                            @elseif($p->status === 'dikembalikan' && $p->total_denda > 0)
                                                {{-- Tombol Lunasi Denda (setelah siswa membayar tunai) --}}
                                                <form action="{{ route('admin.transaksi.lunasi', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            onclick="return confirm('Lunasi denda sebesar Rp {{ number_format($p->total_denda, 0, ',', '.') }}? Pastikan siswa sudah membayar.')"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[10px] font-bold hover:bg-emerald-700 transition-all duration-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Lunasi
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Tombol Hapus (untuk semua status) --}}
                                            <form action="{{ route('admin.transaksi.destroy', $p->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Hapus permanen data transaksi ini?')"
                                                        class="p-1.5 bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 rounded-lg transition-all duration-200 border border-slate-200 hover:border-red-200">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 border border-slate-200">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-black text-slate-400">Belum ada data transaksi</p>
                                            <p class="text-xs text-slate-300 font-medium mt-1 mb-4">Tambahkan transaksi peminjaman baru</p>
                                            <a href="{{ route('admin.transaksi.create') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Input Pinjaman Baru
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($peminjamans->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $peminjamans->links() }}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>