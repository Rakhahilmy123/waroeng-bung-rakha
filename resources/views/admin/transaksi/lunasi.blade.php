<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Lunasi Denda</h2>
            </div>
            <a href="{{ route('admin.transaksi.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all duration-200 border border-slate-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Transaksi
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0 0c1.657 0 3 .895 3 2s-1.343 2-3 2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-900">Konfirmasi Pelunasan Denda</p>
                            <p class="text-[10px] text-slate-400 font-medium">Pastikan siswa sudah membayar denda secara tunai</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    {{-- Informasi Transaksi --}}
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Nama Siswa</p>
                                <p class="font-bold text-slate-900">{{ $peminjaman->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">NIS</p>
                                <p class="font-medium text-slate-700">{{ $peminjaman->user->nis ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Judul Buku</p>
                                <p class="font-bold text-slate-900">{{ $peminjaman->buku->judul_buku }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal Dikembalikan</p>
                                <p class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($peminjaman->tanggal_nyata_kembali)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Denda yang Harus Dibayar</p>
                                <p class="text-2xl font-black text-red-600">Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Konfirmasi --}}
                    <form action="{{ route('admin.transaksi.lunasi.proses', $peminjaman->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <div>
                                    <p class="text-xs font-bold text-yellow-800 uppercase tracking-wider">Konfirmasi</p>
                                    <p class="text-xs text-yellow-700 mt-1">
                                        Dengan mengklik tombol "Lunasi", Anda menyatakan bahwa siswa telah membayar denda sebesar <strong>Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}</strong> secara tunai.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <a href="{{ route('admin.transaksi.index') }}"
                               class="flex-1 px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-wider text-center hover:bg-slate-50 transition">
                                Batal
                            </a>
                            <button type="submit"
                                    class="flex-1 px-4 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-emerald-700 transition shadow-sm">
                                <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Konfirmasi Pelunasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>