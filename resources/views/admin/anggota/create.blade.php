<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Tambah Anggota Baru</h2>
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
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-0.5">Petunjuk</p>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Akun yang dibuat akan langsung dapat login. Verifikasi keanggotaan fisik dilakukan secara terpisah melalui halaman daftar anggota.
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Registrasi Anggota Baru</p>
                        <p class="text-[10px] text-slate-400 font-medium">Isi data siswa dengan lengkap</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="{{ route('admin.anggota.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    {{-- Nama & NIS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap siswa..."
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
                            <input type="text" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 232410209"
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
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="siswa@gmail.com"
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
                            <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="0812..."
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
                        <textarea name="alamat" rows="3" placeholder="Masukkan alamat tempat tinggal..."
                                  class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all resize-none
                                         @error('alamat') border-red-300 @else border-slate-200 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-100 pt-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] mb-4">Keamanan Akun</p>

                        {{-- Password & Konfirmasi --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                    Password <span class="text-red-400">*</span>
                                </label>
                                <input type="password" name="password" placeholder="Min. 8 karakter"
                                       class="w-full px-4 py-3 bg-[#F1F5F9] border rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                              @error('password') border-red-300 @else border-slate-200 @enderror">
                                @error('password')
                                    <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                    Konfirmasi Password <span class="text-red-400">*</span>
                                </label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password..."
                                       class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all">
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Anggota
                        </button>
                        <a href="{{ route('admin.anggota.index') }}"
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