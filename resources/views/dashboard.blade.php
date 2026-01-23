<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="bg-blue-500 rounded-2xl p-8 mb-8 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="text-white">
                        <h3 class="text-2xl font-bold mb-1">
                            Selamat Datang, {{ auth()->user()->name }}! 👋
                        </h3>
                        <div class="flex items-center gap-2 text-indigo-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium capitalize">{{ auth()->user()->role }}</span>
                        </div>
                    </div>
                </div>

                <!-- Role Description -->
                <div class="mt-6 bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                    <p class="text-white text-sm">
                        @if (auth()->user()->role == 'superadmin')
                            🔐 Anda memiliki akses penuh pada sistem
                        @elseif (auth()->user()->role == 'admin')
                            📦 Anda dapat mengelola barang dan diskon
                        @elseif (auth()->user()->role == 'operator')
                            💳 Anda dapat melakukan transaksi
                        @endif
                    </p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
            @if (in_array(auth()->user()->role, ['admin', 'superadmin']))
                                <!-- Total Barang -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Total Barang
                            </p>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($totalBarang, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Item dalam inventori
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Total Transaksi
                            </p>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($totalTransaksi, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Transaksi tercatat
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Omzet -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Total Omzet
                            </p>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                                Rp {{ number_format($totalOmzet, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Pendapatan keseluruhan
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Aksi Cepat
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    
                    @if (auth()->user()->role === 'operator')
                        <a href="{{ route('transaksi.create') }}" 
                           class="flex items-center gap-3 p-4 rounded-lg bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border border-indigo-100 dark:border-indigo-800 hover:shadow-md transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Transaksi Baru</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Buat transaksi</p>
                            </div>
                        </a>
                    @endif

                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                        <a href="{{ route('barang.index') }}" 
                           class="flex items-center gap-3 p-4 rounded-lg bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 border border-blue-100 dark:border-blue-800 hover:shadow-md transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Kelola Barang</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Inventori barang</p>
                            </div>
                        </a>
                    @endif

                    @if (auth()->user()->role === 'superadmin')
                        <a href="{{ route('users.index') }}" 
                           class="flex items-center gap-3 p-4 rounded-lg bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-100 dark:border-green-800 hover:shadow-md transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Kelola User</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Manajemen user</p>
                            </div>
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" 
                                class="flex items-center gap-3 p-4 rounded-lg bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-100 dark:border-green-800 hover:shadow-md transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Profil Saya</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Pengaturan akun</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>