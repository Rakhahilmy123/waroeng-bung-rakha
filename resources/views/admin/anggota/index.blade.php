<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Data Anggota</h2>
            </div>
            <a href="{{ route('admin.anggota.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Anggota
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Success / Error Message --}}
            @if(session('success'))
            <div class="flex items-start gap-3 bg-white border border-emerald-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-emerald-700 uppercase tracking-[0.2em] mb-0.5">Berhasil</p>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="flex items-start gap-3 bg-white border border-red-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-red-600 uppercase tracking-[0.2em] mb-0.5">Gagal</p>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Filter dan Pencarian --}}
<div class="mb-6">
    <form method="GET" action="{{ route('admin.anggota.index') }}" class="flex flex-col sm:flex-row gap-3">
        <!-- Search Input -->
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari nama, NIS, email, atau nomor anggota..." 
                   class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
        </div>

        <!-- Filter Status Verifikasi -->
        <div class="w-full sm:w-48">
            <select name="status" class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl text-sm font-medium">
                <option value="">Semua Status</option>
                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Belum Terverifikasi</option>
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
                <a href="{{ route('admin.anggota.index') }}" 
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
            @if(request('status')) dengan status <strong>{{ request('status') == 'verified' ? 'Terverifikasi' : 'Belum Terverifikasi' }}</strong> @endif
            (Total {{ $siswas->total() }} anggota)
        </div>
    @endif
</div>
            {{-- Table --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Daftar Anggota Siswa</p>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Card Header --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-black text-slate-900">Data Siswa</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-wider">
                            {{ $siswas->total() }} Anggota
                        </span>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/70">
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Data Siswa</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Kontak & Alamat</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">No. Anggota</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Status</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($siswas as $siswa)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 group">

                                    {{-- Data Siswa --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-slate-900 flex items-center justify-center shrink-0 transition-colors duration-200 font-black text-sm text-slate-500 group-hover:text-white">
                                                {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $siswa->name }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">NIS: {{ $siswa->nis ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kontak & Alamat --}}
                                    <td class="px-6 py-4">
                                        <p class="text-xs font-semibold text-slate-700">{{ $siswa->email }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 truncate max-w-[200px]">
                                            {{ $siswa->telepon ?? '-' }} · {{ $siswa->alamat ?? '-' }}
                                        </p>
                                    </td>

                                    {{-- No. Anggota --}}
                                    <td class="px-6 py-4">
                                        @if($siswa->nomor_anggota)
                                            <span class="text-xs font-mono font-bold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-lg">
                                                {{ $siswa->nomor_anggota }}
                                            </span>
                                        @else
                                            <span class="text-[10px] text-slate-300 font-medium">—</span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($siswa->is_verified_anggota)
                                            <span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-lg uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-[9px] font-black text-amber-700 bg-amber-100 px-2.5 py-1 rounded-lg uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                                Belum Anggota
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">

                                            {{-- Verifikasi / Batalkan --}}
                                            @if(!$siswa->is_verified_anggota)
                                                <form action="{{ route('admin.anggota.verifikasi', $siswa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-900 text-white rounded-lg text-[10px] font-bold hover:bg-slate-700 transition-all duration-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Verifikasi
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.anggota.batalkan', $siswa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-500 hover:bg-amber-50 hover:text-amber-600 rounded-lg text-[10px] font-bold transition-all duration-200 border border-slate-200 hover:border-amber-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.anggota.edit', $siswa->id) }}"
                                               class="p-1.5 bg-slate-100 text-slate-500 hover:bg-slate-900 hover:text-white rounded-lg transition-all duration-200 border border-slate-200 hover:border-slate-900">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('admin.anggota.destroy', $siswa->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
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
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 border border-slate-200">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-black text-slate-400">Belum ada data anggota</p>
                                            <p class="text-xs text-slate-300 font-medium mt-1 mb-4">Tambahkan anggota siswa baru ke sistem</p>
                                            <a href="{{ route('admin.anggota.create') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Anggota Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($siswas->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $siswas->links() }}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>