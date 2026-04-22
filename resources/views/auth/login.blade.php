<x-guest-layout>
    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
        
        <div class="w-full lg:w-1/2 space-y-8">
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-900 uppercase tracking-[0.4em]">Selamat datang kawan!</p>
                <h1 class="text-5xl font-black text-slate-900 leading-tight tracking-tighter">
                    Lanjutkan <br> <span class="italic text-slate-500">Perjalananmu.</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium leading-relaxed max-w-sm">
                    Masuk ke panel Nautica Library untuk melanjutkan akses ke ribuan buku, dan pinjam buku favoritmu kapan saja, di mana saja.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-[450px]">
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-[0_50px_100px_-20px_rgba(15,23,42,0.08)] border border-white">
                
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Perpustakaan</label>
                            <input type="email" name="email" :value="old('email')" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900/10 focus:bg-white transition-all text-sm font-bold text-slate-900 placeholder:text-slate-300" placeholder="nim@angkasa.sch.id" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center justify-between px-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-[10px] font-black text-slate-900 uppercase tracking-widest hover:underline" href="{{ route('password.request') }}">Lupa?</a>
                                @endif
                            </div>
                            <input type="password" name="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900/10 focus:bg-white transition-all text-sm font-bold text-slate-900 placeholder:text-slate-300" placeholder="••••••••" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="rounded-md bg-slate-100 border-none text-slate-900 shadow-sm focus:ring-slate-900/20" name="remember">
                            <span class="ms-2 text-[11px] font-bold text-slate-400 group-hover:text-slate-600 transition-colors uppercase tracking-widest">Ingat saya</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="group w-full flex items-center justify-between p-1.5 bg-slate-900 rounded-full hover:bg-slate-800 transition-all duration-500 shadow-xl shadow-slate-200">
                            <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center text-slate-900 group-hover:rotate-45 transition-transform duration-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <span class="text-white font-black text-[11px] uppercase tracking-[0.2em] pr-8">Masuk Sekarang</span>
                        </button>
                    </div>

                    <div class="text-center pt-4">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Belum punya akses? 
                            <a class="text-slate-900 font-black underline underline-offset-4 ml-1" href="{{ route('register') }}">
                                Buat Akun Baru
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>