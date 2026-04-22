<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Perpustakaan Digital</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Katalog Buku</h2>
            </div>
            <a href="{{ route('peminjaman.riwayat') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all duration-200 border border-slate-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Riwayat Pinjaman
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Flash Messages --}}
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

{{-- Form Pencarian --}}
<div class="mb-6">
    <form method="GET" action="{{ route('peminjaman.index') }}" class="flex flex-col sm:flex-row gap-3">
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
                <a href="{{ route('peminjaman.index') }}" 
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
    @endif
</div>

            {{-- Section Label --}}
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em]">Koleksi Tersedia</p>

            {{-- Grid Buku --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($bukus as $buku)
                @php
                    $coverExists = !empty($buku->gambar)
                        && \Illuminate\Support\Facades\Storage::disk('public')->exists($buku->gambar);
                @endphp

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col group">

                    {{-- Cover Buku --}}
                    <div class="h-48 overflow-hidden bg-slate-100 flex items-center justify-center shrink-0 relative">
                        @if($coverExists)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($buku->gambar) }}"
                                 alt="{{ $buku->judul_buku }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="flex flex-col items-center justify-center gap-2 text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="text-[10px] font-bold uppercase tracking-wide">Tidak ada cover</span>
                            </div>
                        @endif

                        {{-- Stok badge --}}
                        <div class="absolute top-2.5 right-2.5">
                            @if($buku->stok > 0)
                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-emerald-700 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg border border-emerald-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Stok {{ $buku->stok }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-red-700 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg border border-red-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Info Buku --}}
                    <div class="p-4 flex flex-col flex-1">
                        @if($buku->kategori)
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">
                            {{ $buku->kategori->nama_kategori }}
                        </span>
                        @endif

                        <h3 class="font-black text-sm text-slate-900 line-clamp-2 leading-snug mb-1">
                            {{ $buku->judul_buku }}
                        </h3>
                        <p class="text-[11px] text-slate-500 font-medium">{{ $buku->penulis ?? '-' }}</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 truncate">{{ $buku->penerbit ?? '-' }}</p>

                        <div class="flex-1"></div>

                        <div class="mt-4">
                            @if($buku->stok > 0)
                                <button type="button"
                                        onclick="openLoanModal({{ $buku->id }}, '{{ addslashes($buku->judul_buku) }}')"
                                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-700 transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Pinjam Buku
                                </button>
                            @else
                                <button disabled
                                        class="w-full py-2.5 bg-slate-100 text-slate-300 rounded-xl text-xs font-bold cursor-not-allowed border border-slate-200">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center py-20 bg-white rounded-2xl border border-slate-200">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 border border-slate-200">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p class="text-sm font-black text-slate-400">Belum ada buku tersedia</p>
                        <p class="text-xs text-slate-300 font-medium mt-1">Koleksi perpustakaan akan segera ditambahkan</p>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($bukus->hasPages())
            <div class="pt-2">
                {{ $bukus->links() }}
            </div>
            @endif

        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- MODAL KONFIRMASI PEMINJAMAN                --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div id="loanModal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm"
         style="display:none;">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 border border-slate-200 overflow-hidden">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Konfirmasi Peminjaman</p>
                        <p class="text-[10px] text-slate-400 font-medium">Tentukan periode peminjaman</p>
                    </div>
                </div>
                <button onclick="closeLoanModal()"
                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <form action="{{ route('peminjaman.store') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="buku_id" id="modal_buku_id">

                {{-- Info Buku --}}
                <div class="flex items-start gap-3 bg-[#F1F5F9] rounded-xl p-3.5 border border-slate-200">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-0.5">Judul Buku</p>
                        <p id="modal_judul_buku" class="text-sm font-black text-slate-900 leading-snug"></p>
                    </div>
                </div>

                {{-- Tanggal Pinjam --}}
                <div>
                    <label for="tanggal_pinjam" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                        Tanggal Pinjam
                    </label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                           value="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
                </div>

                {{-- Tanggal Kembali --}}
                <div>
                    <label for="tanggal_kembali" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                        Tanggal Kembali
                    </label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                           value="{{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}"
                           min="{{ \Carbon\Carbon::now()->addDay(1)->format('Y-m-d') }}"
                           max="{{ \Carbon\Carbon::now()->addDays(14)->format('Y-m-d') }}"
                           class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
                    <p class="text-[10px] text-slate-400 font-medium mt-1.5">Maksimal 14 hari dari tanggal pinjam.</p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2 pt-1">
                    <button type="button" onclick="closeLoanModal()"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 transition-all duration-200 border border-slate-200 font-bold text-xs uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Konfirmasi Pinjam
                    </button>
                </div>

            </form>
        </div>
    </div>

<script>
    function openLoanModal(bukuId, judulBuku) {
        document.getElementById('modal_buku_id').value = bukuId;
        document.getElementById('modal_judul_buku').innerText = judulBuku;
        
        // Reset tanggal ke default setiap kali modal dibuka
        const today = new Date().toISOString().split('T')[0];
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 14);
        
        document.getElementById('tanggal_pinjam').value = today;
        document.getElementById('tanggal_pinjam').min = today;
        document.getElementById('tanggal_kembali').value = new Date(Date.now() + 7*86400000).toISOString().split('T')[0];
        document.getElementById('tanggal_kembali').min = today; // ✅ min = hari ini
        document.getElementById('tanggal_kembali').max = maxDate.toISOString().split('T')[0];

        const modal = document.getElementById('loanModal');
        modal.style.display = 'flex';
    }

    // ✅ Saat tanggal pinjam berubah, update min & max tanggal kembali
    document.getElementById('tanggal_pinjam').addEventListener('change', function() {
        const pinjam = new Date(this.value);
        const maxKembali = new Date(pinjam);
        maxKembali.setDate(maxKembali.getDate() + 14);

        document.getElementById('tanggal_kembali').min = this.value;
        document.getElementById('tanggal_kembali').max = maxKembali.toISOString().split('T')[0];
        
        // Jika tanggal kembali lebih kecil dari tanggal pinjam, reset
        if (document.getElementById('tanggal_kembali').value < this.value) {
            document.getElementById('tanggal_kembali').value = this.value;
        }
    });

    function closeLoanModal() {
        document.getElementById('loanModal').style.display = 'none';
    }

    document.getElementById('loanModal').addEventListener('click', function(e) {
        if (e.target === this) closeLoanModal();
    });
</script>
</x-app-layout>