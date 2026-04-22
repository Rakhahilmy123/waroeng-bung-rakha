<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            /* Custom scrollbar yang lebih halus untuk tema terang */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        </style>
    </head>
    <body class="antialiased bg-[#F8FAFC] text-slate-900">
        
        <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
            
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1 min-w-0 overflow-hidden relative">
                
                <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 z-40">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>

                    <div class="hidden md:block">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Sistem Informasi</span>
                        <h2 class="text-sm font-extrabold text-slate-800 tracking-tight">Nautica Library</h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-wide mt-1">{{ Auth::user()->role }}</p>
                        </div>
                        
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="focus:outline-none group">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-bold group-hover:border-indigo-500/50 group-hover:bg-indigo-50 transition-all duration-300">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xl">
                                    <x-dropdown-link :href="route('profile.edit')" class="hover:bg-slate-50 text-slate-600 font-medium">Profil</x-dropdown-link>
                                    <div class="border-t border-slate-100"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500 hover:bg-red-50 font-medium">
                                            Keluar
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                @if (isset($header))
                    <div class="px-8 py-6 bg-white border-b border-slate-100">
                        <div class="max-w-7xl mx-auto">
                            {{ $header }}
                        </div>
                    </div>
                @endif

                <main class="flex-1 overflow-y-auto px-4 sm:px-8 pt-8 pb-12">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>

                <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-indigo-500/[0.03] blur-[120px] rounded-full"></div>
                <div class="absolute bottom-0 left-0 -z-10 w-[500px] h-[500px] bg-blue-500/[0.03] blur-[120px] rounded-full"></div>
            </div>
        </div>

        {{-- ========== SPLASH SCREEN COMPONENT ========== --}}
        <x-splash-screen />
        {{-- ========== END SPLASH SCREEN ========== --}}

        {{-- Script tambahan untuk clear session splash screen --}}
        @if(session('show_splash'))
        <script>
            // Hapus session splash screen setelah tampil
            setTimeout(function() {
                fetch('{{ route("clear-splash-session") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).catch(err => console.log('Session clear error:', err));
            }, 3000);
        </script>
        @endif

    </body>
</html>