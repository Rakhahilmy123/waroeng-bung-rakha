<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Tambah Pinjaman Baru</h2>
            </div>
            <a href="{{ route('admin.transaksi.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all duration-200 border border-slate-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Info Banner --}}
            <div class="flex items-start gap-3 bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-0.5">Petunjuk</p>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Input pinjaman manual oleh admin. Pastikan siswa dan buku yang dipilih sudah sesuai sebelum menyimpan transaksi.
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Form Pinjaman Manual</p>
                        <p class="text-[10px] text-slate-400 font-medium">Isi semua field yang diperlukan</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="{{ route('admin.transaksi.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    {{-- Pilih Siswa --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Siswa / Anggota <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="user_id"
                                    class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 appearance-none cursor-pointer text-sm font-medium transition-all
                                           @error('user_id') border-red-300 @else border-slate-200 @enderror">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->nis ?? 'No NIS' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        @error('user_id')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pilih Buku --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Judul Buku <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="buku_id"
                                    class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 appearance-none cursor-pointer text-sm font-medium transition-all
                                           @error('buku_id') border-red-300 @else border-slate-200 @enderror">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul_buku }} (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        @error('buku_id')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Pinjam & Kembali --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Tanggal Pinjam <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
                            @error('tanggal_pinjam')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Batas Kembali <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_kembali"
                                   value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}"
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-medium transition-all">
                            @error('tanggal_kembali')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Transaksi
                        </button>
                        <a href="{{ route('admin.transaksi.index') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-white text-slate-600 rounded-xl hover:bg-slate-100 transition-all duration-200 border border-slate-200 font-bold text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>