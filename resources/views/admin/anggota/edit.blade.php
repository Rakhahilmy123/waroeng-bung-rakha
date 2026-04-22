<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Edit Data Anggota</h2>
            </div>
            <a href="{{ route('admin.anggota.index') }}"
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
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-0.5">Informasi</p>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Anda sedang mengubah data anggota:
                        <span class="font-black text-slate-700">{{ $user->name }}</span>.
                        Status verifikasi dan nomor anggota tidak akan berubah.
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Update Data Anggota</p>
                        <p class="text-[10px] text-slate-400 font-medium">Perbarui informasi siswa di bawah</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="{{ route('admin.anggota.update', $user->id) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')

                    {{-- Nama & NIS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('name') border-red-300 @else border-slate-200 @enderror">
                            @error('name')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                NIS <span class="text-slate-300 font-medium normal-case tracking-normal">(opsional)</span>
                            </label>
                            <input type="text" name="nis" value="{{ old('nis', $user->nis) }}" placeholder="Masukkan NIS..."
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('nis') border-red-300 @else border-slate-200 @enderror">
                            @error('nis')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Email & Telepon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('email') border-red-300 @else border-slate-200 @enderror">
                            @error('email')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Telepon / WA <span class="text-slate-300 font-medium normal-case tracking-normal">(opsional)</span>
                            </label>
                            <input type="text" name="telepon" value="{{ old('telepon', $user->telepon) }}" placeholder="0812..."
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('telepon') border-red-300 @else border-slate-200 @enderror">
                            @error('telepon')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Alamat Lengkap <span class="text-slate-300 font-medium normal-case tracking-normal">(opsional)</span>
                        </label>
                        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap..."
                                  class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Keanggotaan (Read Only) --}}
                    <div class="bg-[#F1F5F9] rounded-xl border border-slate-200 p-4">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Status Keanggotaan</p>
                        @if($user->is_verified_anggota)
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-emerald-700 bg-emerald-100 px-3 py-1.5 rounded-lg uppercase tracking-wide border border-emerald-200">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Terverifikasi
                                </span>
                                <span class="text-xs font-mono font-bold text-slate-500">{{ $user->nomor_anggota }}</span>
                            </div>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-amber-700 bg-amber-100 px-3 py-1.5 rounded-lg uppercase tracking-wide border border-amber-200">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                Belum Menjadi Anggota
                            </span>
                        @endif
                        <p class="text-[10px] text-slate-400 font-medium mt-2">Status ini hanya dapat diubah melalui tombol Verifikasi / Batalkan di halaman daftar anggota.</p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-2 pt-5 border-t border-slate-100">
                        <a href="{{ route('admin.anggota.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 transition-all duration-200 border border-slate-200 font-bold text-xs uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>