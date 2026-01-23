<nav x-data="{ open: false }" class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 transition-transform hover:scale-105">
                        <x-application-logo class="h-8 w-auto fill-current text-blue-600 dark:text-blue-400" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-1">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                              {{ request()->routeIs('dashboard') 
                                  ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' 
                                  : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-blue-400 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </span>
                    </a>

                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                        <a href="{{ route('barang.index') }}" 
                           class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                                  {{ request()->routeIs('barang.*') 
                                      ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' 
                                      : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Barang
                            </span>
                        </a>
                    @endif

                    @if (auth()->user()->role === 'operator')
                        <a href="{{ route('transaksi.create') }}" 
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                                {{ request()->routeIs('transaksi.*') 
                                    ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' 
                                    : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Transaksi
                            </span>
                        </a>
                    @endif

                    @if (auth()->user()->role === 'superadmin')
                        <a href="{{ route('users.index') }}" 
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                                {{ request()->routeIs('users.*') 
                                    ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' 
                                    : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Manajemen User
                            </span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                                    text-gray-700 dark:text-gray-300 
                                    hover:bg-gray-50 dark:hover:bg-gray-800/50
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500/20
                                    transition-all duration-200">
                            <div class="text-left">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1">
                            <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" 
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 
                                    hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 
                                            hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors border-t border-gray-100 dark:border-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-400 
                                hover:text-gray-900 dark:hover:text-white 
                                hover:bg-gray-100 dark:hover:bg-gray-800 
                                focus:outline-none focus:ring-2 focus:ring-indigo-500/20
                                transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" 
                        class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" 
                        class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200/50 dark:border-gray-700/50">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all
                    {{ request()->routeIs('dashboard') 
                        ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' 
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                <a href="{{ route('barang.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all
                        {{ request()->routeIs('barang.*') 
                            ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' 
                            : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Barang
                </a>
            @endif

            @if (auth()->user()->role === 'operator')
                <a href="{{ route('transaksi.create') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all
                        {{ request()->routeIs('transaksi.*') 
                            ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' 
                            : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Transaksi
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-4 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="px-4 space-y-1">
                <a href="{{ route('profile.edit') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 
                        hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 
                                hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>