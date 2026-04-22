<x-guest-layout>
    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

        <div class="w-full lg:w-1/2 space-y-8">
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-900 uppercase tracking-[0.4em]">Kami disini membantu kamu</p>
                <h1 class="text-5xl font-black text-slate-900 leading-tight tracking-tighter">
                    Untuk bergabung di <br> <span class="italic text-slate-500">Nautica Library.</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium leading-relaxed max-w-sm">
                    Daftar sekarang untuk melakukan peminjaman buku di Nautica Library kapan saja, di mana saja.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-[450px]">
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-[0_50px_100px_-20px_rgba(15,23,42,0.08)] border border-white">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-4">

                        {{-- Nama Lengkap --}}
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900/10 focus:bg-white transition-all text-sm font-bold text-slate-900 placeholder:text-slate-300
                                          @error('name') ring-2 ring-red-400 @enderror"
                                   placeholder="masukkan nama lengkap..." required>
                            @error('name')
                                <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900/10 focus:bg-white transition-all text-sm font-bold text-slate-900 placeholder:text-slate-300
                                          @error('email') ring-2 ring-red-400 @enderror"
                                   placeholder="masukkan alamat email..." required>
                            @error('email')
                                <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIS & WhatsApp --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">NIS</label>
                                <input type="text" name="nis" value="{{ old('nis') }}"
                                       class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-bold placeholder:text-slate-300
                                              @error('nis') ring-2 ring-red-400 @enderror"
                                       placeholder="masukkan NIS..." required>
                                @error('nis')
                                    <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">WhatsApp</label>
                                <input type="text" name="telepon" value="{{ old('telepon') }}"
                                       class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-bold placeholder:text-slate-300
                                              @error('telepon') ring-2 ring-red-400 @enderror"
                                       placeholder="masukkan nomor WhatsApp..." required>
                                @error('telepon')
                                    <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat (field yang sebelumnya tidak ada) --}}
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3"
                                      class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900/10 focus:bg-white transition-all text-sm font-bold text-slate-900 placeholder:text-slate-300 resize-none
                                             @error('alamat') ring-2 ring-red-400 @enderror"
                                      placeholder="Jl. Contoh No. 123, Kota...">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password & Konfirmasi --}}
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                                <input type="password" name="password"
                                       class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-bold placeholder:text-slate-300
                                              @error('password') ring-2 ring-red-400 @enderror"
                                       placeholder="Password" required>
                                @error('password')
                                    <p class="text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-bold placeholder:text-slate-300"
                                       placeholder="Konfirmasi Password" required>
                            </div>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="pt-4">
                        <button type="submit" class="group w-full flex items-center justify-between p-1.5 bg-slate-900 rounded-full hover:bg-slate-800 transition-all duration-500 shadow-xl shadow-slate-200">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-slate-900 group-hover:rotate-45 transition-transform duration-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="text-white font-black text-[11px] uppercase tracking-[0.2em] pr-8">Get Started</span>
                        </button>
                    </div>

                    <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest pt-2">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-slate-900 font-black underline underline-offset-4 ml-1">Login</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>