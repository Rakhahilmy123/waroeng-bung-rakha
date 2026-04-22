{{-- Mobile Overlay --}}
<div x-show="sidebarOpen"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 md:hidden"
     @click="sidebarOpen = false">
</div>

{{-- Sidebar with hover expand --}}
<div x-data="{ expanded: false }"
     @mouseenter="expanded = true"
     @mouseleave="expanded = false"
     :class="[
         sidebarOpen ? 'translate-x-0' : '-translate-x-full',
         expanded ? 'w-60' : 'w-[68px]'
     ]"
     class="fixed inset-y-0 left-0 z-50 md:relative md:translate-x-0
            flex flex-col
            bg-[#F1F5F9] border-r border-slate-200
            transition-all duration-300 ease-in-out
            overflow-hidden">

    {{-- Brand / Logo --}}
    <div class="h-16 flex items-center px-[22px] border-b border-slate-200 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group min-w-max">
            <div class="w-6 h-6 shrink-0 flex items-center justify-center">
            </div>
            <div x-show="expanded"
                 x-transition:enter="transition-opacity duration-200 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="flex flex-col leading-none whitespace-nowrap">
                <span class="font-black text-slate-900 text-sm tracking-widest">Nautica Library</span>
                <span class="text-[9px] font-semibold text-slate-400 tracking-[0.25em] uppercase mt-0.5">Terbaik Mantap</span>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 space-y-5 custom-scrollbar">

        {{-- Dashboard --}}
        <div>
            <div x-show="expanded"
                 x-transition:enter="transition-opacity duration-150 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-5 mb-1">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.35em]">Dashboard</p>
            </div>

            <div class="px-3 space-y-0.5">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('dashboard')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Beranda Utama">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Beranda Utama
                    </span>
                </a>
            </div>
        </div>

        <div class="mx-5 border-t border-slate-200"></div>

        {{-- Admin Management --}}
        @if(auth()->user()->role === 'admin')
        <div>
            <div x-show="expanded"
                 x-transition:enter="transition-opacity duration-150 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-5 mb-1">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.35em]">Manajemen</p>
            </div>

            <div class="px-3 space-y-0.5">

                <a href="{{ route('buku.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('buku.*')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Katalog Buku">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('buku.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Kelola Buku
                    </span>
                </a>

                <a href="{{ route('kategori.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('kategori.*')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Kategori Buku">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('kategori.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Kategori Buku
                    </span>
                </a>

                <a href="{{ route('admin.transaksi.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('admin.transaksi.*')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Sirkulasi Pinjam">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.transaksi.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Transaksi/Sirkulasi
                    </span>
                </a>

                <a href="{{ route('admin.anggota.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('admin.anggota.*')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Data Anggota">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.anggota.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Kelola Anggota
                    </span>
                </a>

            </div>
        </div>
        @endif

        {{-- Siswa Library --}}
        @if(auth()->user()->role === 'siswa')
        <div>
            <div x-show="expanded"
                 x-transition:enter="transition-opacity duration-150 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-5 mb-1">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.35em]">Library</p>
            </div>

            <div class="px-3 space-y-0.5">
                <a href="{{ route('peminjaman.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 group min-w-max
                          {{ request()->routeIs('peminjaman.*')
                             ? 'bg-slate-900 text-white shadow-sm'
                             : 'text-slate-500 hover:bg-slate-200/80 hover:text-slate-900' }}"
                   title="Pinjaman Saya">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('peminjaman.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span x-show="expanded"
                          x-transition:enter="transition-opacity duration-150 delay-100"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition-opacity duration-100"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="text-sm font-semibold whitespace-nowrap">
                        Pinjam Buku
                    </span>
                </a>
            </div>
        </div>
        @endif

    </nav>

    {{-- Divider --}}
    <div class="mx-5 border-t border-slate-200"></div>

    {{-- User Footer --}}
    <div class="p-3 shrink-0 space-y-0.5">

        <div class="flex items-center gap-3 px-3 py-2 min-w-max">
            <div class="relative shrink-0">
                <div class="w-[30px] h-[30px] rounded-lg bg-slate-900 flex items-center justify-center text-white text-[11px] font-black">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="absolute -bottom-0.5 -right-0.5 w-2 h-2 bg-emerald-400 border-2 border-[#F1F5F9] rounded-full"></div>
            </div>
            <div x-show="expanded"
                 x-transition:enter="transition-opacity duration-150 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="flex flex-col min-w-0 whitespace-nowrap">
                <span class="text-xs font-bold text-slate-900 truncate max-w-[140px]">{{ Auth::user()->name }}</span>
                <span class="text-[9px] font-semibold text-slate-400 uppercase tracking-widest">{{ Auth::user()->role }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-red-50 hover:text-red-500 rounded-xl transition-all duration-150 group min-w-max"
                    title="Keluar Sesi">
                <svg class="w-[18px] h-[18px] shrink-0 group-hover:text-red-400 transition-colors"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span x-show="expanded"
                      x-transition:enter="transition-opacity duration-150 delay-100"
                      x-transition:enter-start="opacity-0"
                      x-transition:enter-end="opacity-100"
                      x-transition:leave="transition-opacity duration-100"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      class="text-sm font-semibold whitespace-nowrap">
                    Keluar Sesi
                </span>
            </button>
        </form>
    </div>

</div>