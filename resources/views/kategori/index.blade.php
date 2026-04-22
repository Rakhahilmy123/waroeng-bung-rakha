<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Kategori Buku</h2>
            </div>
            <div class="flex items-center gap-2">
                @if(in_array(auth()->user()->role, ['admin','superadmin']))
                <a href="{{ route('buku.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all duration-200 border border-slate-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Data Buku
                </a>
                @endif
                <a href="{{ route('kategori.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kategori
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Success Message --}}
            @if(session('success'))
            <div class="flex items-start gap-3 bg-white border border-emerald-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-black text-emerald-700 uppercase tracking-[0.2em] mb-0.5">Berhasil</p>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
            @endif

                        {{-- Section Label --}}
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em]">Koleksi Tersedia</p>
            {{-- Form Pencarian --}}
<div class="mb-6">
    <form method="GET" action="{{ route('kategori.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari kategori..." 
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
                <a href="{{ route('kategori.index') }}" 
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
            Ditemukan <strong>{{ $kategoris->total() }}</strong> kategori untuk keyword 
            <strong>"{{ request('search') }}"</strong>
        </p>
    @endif
</div>

            {{-- Table Card --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Daftar Kategori</p>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Card Header --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-black text-slate-900">Daftar Kategori</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-wider">
                            {{ $kategoris->count() }} Kategori
                        </span>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/70">
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] w-16">No</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Nama Kategori</th>
                                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($kategoris as $index => $kategori)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 group">

                                    {{-- No --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-slate-100 text-slate-500 font-black text-xs group-hover:bg-slate-900 group-hover:text-white transition-colors duration-200">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    {{-- Nama Kategori --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-slate-900 flex items-center justify-center shrink-0 transition-colors duration-200">
                                                <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-bold text-slate-900">{{ $kategori->nama_kategori }}</span>
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                                               class="p-2 bg-slate-100 text-slate-500 hover:bg-slate-900 hover:text-white rounded-lg transition-all duration-200 border border-slate-200 hover:border-slate-900">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                                    <td colspan="3" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 border border-slate-200">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-black text-slate-400">Belum ada kategori</p>
                                            <p class="text-xs text-slate-300 font-medium mt-1 mb-4">Tambahkan kategori untuk mengelompokkan koleksi buku</p>
                                            <a href="{{ route('kategori.create') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Kategori Pertama
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