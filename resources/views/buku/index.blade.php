<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Koleksi Buku</h2>
            </div>
            <a href="{{ route('buku.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STATS --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                {{-- Total Judul --}}
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                            <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $bukus->count() }}</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-1">Total Judul Buku</p>
                </div>

                {{-- Total Stok --}}
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                            <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Stok</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $bukus->sum('stok') }}</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-1">Total Stok Tersedia</p>
                </div>

                {{-- Total Kategori --}}
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                            <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Variasi</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $bukus->groupBy('kategori_id')->count() }}</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-1">Kategori Terdaftar</p>
                </div>

            </div>

             {{-- Section Label --}}
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em]">Koleksi Tersedia</p>
            {{-- Form Pencarian --}}
<div class="mb-6">
    <form method="GET" action="{{ route('buku.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari buku (judul, penulis, penerbit)..." 
                   class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
        </div>
        <div class="flex gap-2">
            <button type="submit" 
                    class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-slate-700 transition-all duration-200 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
            
            @if(request('search'))
                <a href="{{ route('buku.index') }}" 
                   class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-slate-100 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
            @endif
        </div>
    </form>
    
    @if(request('search'))
        <p class="text-xs text-slate-500 mt-2">
            Menampilkan hasil untuk: <strong class="text-slate-800">"{{ request('search') }}"</strong>
        </p>
        <p class="text-sm text-slate-500 mb-2">
            Ditemukan <strong>{{ $bukus->total() }}</strong> buku untuk keyword 
            <strong>"{{ request('search') }}"</strong>
        </p>
    @endif
</div>


            {{-- ═══════════════════════════════════════════ --}}
            {{-- TABLE --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Daftar Koleksi</p>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Table Header Bar --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-sm font-black text-slate-900">Daftar Koleksi</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-wider">
                            {{ $bukus->count() }} Judul
                        </span>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/70">
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Info Buku</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Kategori</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Penerbit / Penulis</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Status Stok</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($bukus as $buku)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 group">

                                    {{-- Info Buku --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-slate-900 flex items-center justify-center shrink-0 transition-colors duration-200">
                                                <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $buku->judul_buku }}</p>
                                                <p class="text-[10px] text-slate-400 font-mono mt-0.5">BK-{{ str_pad($buku->id, 4, '0', STR_PAD_LEFT) }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-black uppercase tracking-wide border border-slate-200">
                                            {{ $buku->kategori->nama_kategori ?? 'Unset' }}
                                        </span>
                                    </td>

                                    {{-- Penerbit / Penulis --}}
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $buku->penulis }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 uppercase tracking-wide">{{ $buku->penerbit }}</p>
                                    </td>

                                    {{-- Status Stok --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-lg font-black {{ $buku->stok > 0 ? 'text-slate-900' : 'text-red-500' }}">
                                                {{ $buku->stok }}
                                            </span>
                                            @if($buku->stok > 5)
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md uppercase">
                                                    <span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                                                    Aman
                                                </span>
                                            @elseif($buku->stok > 0)
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-amber-700 bg-amber-100 px-2 py-0.5 rounded-md uppercase">
                                                    <span class="w-1 h-1 bg-amber-500 rounded-full"></span>
                                                    Sedikit
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-red-700 bg-red-100 px-2 py-0.5 rounded-md uppercase animate-pulse">
                                                    <span class="w-1 h-1 bg-red-500 rounded-full"></span>
                                                    Habis
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('buku.edit', $buku) }}"
                                               class="p-2 bg-slate-100 text-slate-500 hover:bg-slate-900 hover:text-white rounded-lg transition-all duration-200 border border-slate-200 hover:border-slate-900">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                                                  onsubmit="return confirm('Hapus buku ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 rounded-lg transition-all duration-200 border border-slate-200 hover:border-red-200">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-black text-slate-400">Belum ada koleksi buku</p>
                                            <p class="text-xs text-slate-300 font-medium mt-1 mb-4">Tambahkan buku pertama ke katalog perpustakaan</p>
                                            <a href="{{ route('buku.create') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Buku
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>