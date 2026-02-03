<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waroeng Bung Rakha</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white dark:bg-gray-900 flex flex-col min-h-screen">
  <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Kami</h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                    Mengenal lebih dekat Waroeng Bung Rakha, solusi terpercaya untuk kebutuhan transaksi barang Anda
                </p>
            </div>
        </div>
    </div>

    <!-- About Content -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Story Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        Visi & Misi Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                        Membangun Kepercayaan Melalui Transaksi yang Aman
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                        Waroeng Bung Rakha hadir sebagai solusi modern untuk kebutuhan transaksi barang Anda. Kami memahami pentingnya kepercayaan dan keamanan dalam setiap transaksi.
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        Dengan teknologi yang handal dan pelayanan yang ramah, kami berkomitmen untuk memberikan pengalaman terbaik bagi setiap pelanggan kami.
                    </p>
                </div>
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('img/waroeng.png') }}" alt="Waroeng Bung Rakha" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-blue-500 text-white p-6 rounded-xl shadow-xl hidden md:block">
                        <div class="text-4xl font-bold">100+</div>
                        <div class="text-sm">Pelanggan Puas</div>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Nilai-Nilai Kami</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Prinsip yang menjadi fondasi dalam setiap layanan kami
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow border border-gray-100 dark:border-gray-700">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Terpercaya</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Keamanan dan kepercayaan adalah prioritas utama kami dalam setiap transaksi.
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow border border-gray-100 dark:border-gray-700">
                        <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cepat & Efisien</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Proses transaksi yang mudah dan cepat untuk kenyamanan Anda.
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow border border-gray-100 dark:border-gray-700">
                        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Pelayanan Ramah</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Tim kami siap membantu Anda dengan pelayanan yang terbaik.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team/Stats Section -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-3xl p-12 border border-gray-200 dark:border-gray-700">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Bukti nyata komitmen kami untuk memberikan yang terbaik
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Stat 1 -->
                    <div class="text-center">
                        <div class="text-5xl font-bold text-blue-600 dark:text-blue-400 mb-2">100+</div>
                        <div class="text-gray-600 dark:text-gray-400 font-medium">Transaksi Berhasil</div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="text-center">
                        <div class="text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">98%</div>
                        <div class="text-gray-600 dark:text-gray-400 font-medium">Kepuasan Pelanggan</div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="text-center">
                        <div class="text-5xl font-bold text-purple-600 dark:text-purple-400 mb-2">24/7</div>
                        <div class="text-gray-600 dark:text-gray-400 font-medium">Dukungan Pelanggan</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Siap Bertransaksi Bersama Kami?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ratusan pelanggan yang telah mempercayai Waroeng Bung Rakha
            </p>
            <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl font-semibold">
                Hubungi Kami
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>

    </body>
</html>