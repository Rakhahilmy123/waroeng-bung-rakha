<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Selamat Datang</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">
                    Halo, <span class="text-slate-700">{{ auth()->user()->name }}</span> 👋
                </h2>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ═══════════════════════════════════════════ --}}
            {{-- HERO WELCOME CARD --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div class="relative overflow-hidden bg-slate-900 rounded-2xl p-7 shadow-lg">
                <div class="absolute top-0 right-0 w-72 h-72 bg-white/[0.03] rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
                <div class="absolute bottom-0 right-32 w-40 h-40 bg-white/[0.04] rounded-full translate-y-1/2 pointer-events-none"></div>
                <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                     style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>

                <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center text-white text-2xl font-black backdrop-blur-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-400 border-2 border-slate-900 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-white/50 text-[10px] font-bold uppercase tracking-[0.3em] mb-1">{{ auth()->user()->role }}</p>
                            <h3 class="text-white text-xl font-black tracking-tight">{{ auth()->user()->name }}</h3>
                            @if(auth()->user()->role === 'siswa')
                                <span class="inline-flex items-center gap-1.5 mt-1.5 text-[10px] font-bold px-2.5 py-1 rounded-lg
                                    {{ auth()->user()->is_verified_anggota ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ auth()->user()->is_verified_anggota ? 'bg-emerald-400' : 'bg-amber-400' }}"></span>
                                    {{ auth()->user()->is_verified_anggota ? 'Anggota Terverifikasi' : 'Menunggu Verifikasi' }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="md:max-w-sm bg-white/5 border border-white/10 rounded-xl p-4 backdrop-blur-sm">
                        <p class="text-slate-300 text-xs leading-relaxed font-medium">
                            @if(auth()->user()->role === 'admin')
                                <span class="text-white font-black">Admin Panel aktif.</span>
                                Kelola buku, Kelola kategori, pantau sirkulasi peminjaman, dan kelola anggota siswa.
                            @else
                                @if(auth()->user()->is_verified_anggota)
                                    <span class="text-white font-black">Akses penuh terbuka.</span>
                                    Anda dapat meminjam buku yang anda inginkan dari koleksi Nautica Library.
                                @else
                                    <span class="text-amber-400 font-black">Aktivasi diperlukan.</span>
                                    Kunjungi meja pustakawan untuk mengaktifkan kartu anggota Anda.
                                @endif
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STATS SECTION --}}
            {{-- ═══════════════════════════════════════════ --}}
            @if(auth()->user()->role === 'admin')
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Statistik Perpustakaan</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                                <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total</span>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalBuku ?? 0) }}</h3>
                        <p class="text-xs font-semibold text-slate-400 mt-1">Koleksi Buku</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                                <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Aktif</span>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalDipinjam ?? 0) }}</h3>
                        <p class="text-xs font-semibold text-slate-400 mt-1">Aktif Dipinjam</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-2.5 bg-slate-100 rounded-xl group-hover:bg-slate-900 transition-colors duration-200">
                                <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Anggota</span>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalAnggota ?? 0) }}</h3>
                        <p class="text-xs font-semibold text-slate-400 mt-1">Total Anggota</p>
                    </div>

                </div>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2.5 bg-slate-100 rounded-xl">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dipinjam</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900">{{ $myBorrowedBooks ?? 0 }}</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-1">Buku di Tangan</p>
                </div>
                <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2.5 bg-white/10 rounded-xl">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <span class="text-[9px] font-black text-white/30 uppercase tracking-widest">Status</span>
                    </div>
                    <h3 class="text-xl font-black text-white">{{ auth()->user()->is_verified_anggota ? 'Aktif' : 'Belum Aktif' }}</h3>
                    <p class="text-xs font-semibold text-white/40 mt-1">Status Keanggotaan</p>
                </div>
            </div>
            @endif

            {{-- ═══════════════════════════════════════════ --}}
            {{-- MENU UTAMA (full width, smaller compact grid) --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Menu Utama</p>

                {{-- ADMIN: 4 kolom compact --}}
                @if(auth()->user()->role === 'admin')
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

                    {{-- Katalog Buku --}}
                    <a href="{{ route('buku.index') }}"
                       class="group relative overflow-hidden bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-slate-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-slate-100 transition-colors duration-200 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shadow-sm shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] leading-none mb-1">Kelola</p>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">Katalog Buku</h4>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    {{-- Kategori --}}
                    <a href="{{ route('kategori.index') }}"
                       class="group relative overflow-hidden bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-slate-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-slate-100 transition-colors duration-200 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shadow-sm shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] leading-none mb-1">Kelola</p>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">Kategori</h4>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    {{-- transaksi --}}
                    <a href="{{ route('admin.transaksi.index') }}"
                       class="group relative overflow-hidden bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-slate-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-slate-100 transition-colors duration-200 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shadow-sm shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] leading-none mb-1">Pantau</p>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">Transaksi</h4>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-3.5 h-3.5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    {{-- Data Anggota --}}
                    <a href="{{ route('admin.anggota.index') }}"
                       class="group relative overflow-hidden bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-slate-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-slate-100 transition-colors duration-200 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shadow-sm shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] leading-none mb-1">Kelola</p>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">Data Anggota</h4>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                </div>
                @endif

                {{-- SISWA: 2-3 kolom compact --}}
                @if(auth()->user()->role === 'siswa')
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

                    @if(auth()->user()->is_verified_anggota)
                    {{-- Pinjam Buku --}}
                    <a href="{{ route('peminjaman.index') }}"
                       class="group relative overflow-hidden bg-slate-900 rounded-xl p-4 border border-slate-800 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.25em] leading-none mb-1">Aksi</p>
                                <h4 class="text-sm font-black text-white leading-tight">Pinjam Buku</h4>
                            </div>
                        </div>
                    </a>
                    @endif

                    {{-- Pinjaman Saya --}}
                    <a href="{{ route('peminjaman.index') }}"
                       class="group relative overflow-hidden bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-slate-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-slate-100 transition-colors duration-200 pointer-events-none"></div>
                        <div class="relative flex flex-col gap-3">
                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 shadow-sm shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] leading-none mb-1">Riwayat</p>
                                <h4 class="text-sm font-black text-slate-900 leading-tight">Pinjaman Saya</h4>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                </div>
                @endif


            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- INFO SISTEM (full width, compact) --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Info Sistem</p>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-slate-100">
                        <div class="flex flex-col gap-1 px-5 py-4">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Sistem</span>
                            <span class="text-sm font-black text-slate-900">Nautica Library</span>
                            <span class="text-[10px] text-slate-400 font-medium">Nautica v1.0</span>
                        </div>
                        <div class="flex flex-col gap-1 px-5 py-4">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Hari ini</span>
                            <span class="text-sm font-black text-slate-900">{{ now()->format('d M Y') }}</span>
                            <span class="text-[10px] text-slate-400 font-medium">{{ now()->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex flex-col gap-1 px-5 py-4">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Role</span>
                            <span class="inline-flex mt-0.5">
                                <span class="text-[10px] font-black text-white bg-slate-900 px-2.5 py-1 rounded-lg uppercase tracking-wider">
                                    {{ auth()->user()->role }}
                                </span>
                            </span>
                        </div>
                        <div class="flex flex-col gap-1 px-5 py-4">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</span>
                            @if(auth()->user()->role === 'siswa')
                                <span class="inline-flex mt-0.5">
                                    <span class="text-[10px] font-black px-2.5 py-1 rounded-lg
                                        {{ auth()->user()->is_verified_anggota ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ auth()->user()->is_verified_anggota ? 'Aktif' : 'Pending' }}
                                    </span>
                                </span>
                            @else
                                <span class="flex items-center gap-1.5 mt-0.5 text-xs font-bold text-emerald-600">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Online
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>