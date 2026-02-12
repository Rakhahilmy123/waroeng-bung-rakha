<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waroeng Bung Rakha - Tempat Bertransaksi Terpercaya</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }
            
            .delay-100 { animation-delay: 0.1s; opacity: 0; }
            .delay-200 { animation-delay: 0.2s; opacity: 0; }
            .delay-300 { animation-delay: 0.3s; opacity: 0; }
            .delay-400 { animation-delay: 0.4s; opacity: 0; }
        </style>
    </head>
    <body class="antialiased bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 flex flex-col min-h-screen">
        
        <!-- Navigation -->
        <nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 transform transition-transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="text-white" viewBox="0 0 16 16">
                                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5m2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">Waroeng Bung Rakha</span>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#home" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                            Home
                        </a>
                        <a href="#keunggulan" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            Keunggulan
                        </a>
                        <a href="{{ route('about') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            Tentang Kami
                        </a>
                        <a href="{{ route('contact') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            Kontak
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <!-- Hero Section -->
            <section id="home" class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
                    <!-- Hero Banner Card -->
                    <div class="relative bg-gradient-to-br from-blue-400 via-blue-500 to-indigo-500 dark:from-blue-600 dark:via-blue-700 dark:to-indigo-700 rounded-3xl overflow-hidden shadow-2xl">
                        <!-- Decorative Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                            <div class="absolute bottom-10 right-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
                            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-white rounded-full blur-2xl"></div>
                        </div>

                        <!-- Navigation Arrows -->
                        <button id="prevSlide" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-200 z-10 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="nextSlide" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-200 z-10 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="relative grid md:grid-cols-2 gap-8 items-center min-h-[400px] md:min-h-[450px] p-8 md:p-12">
                            <!-- Left Content -->
                            <div id="heroContent" class="relative z-10 text-white space-y-6 animate-fade-in-up">
                                <!-- Badge -->
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium border border-white/30">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                    <span id="heroBadge">Waroeng Bung Rakha</span>
                                </div>

                                <!-- Main Title -->
                                <div>
                                    <h1 id="heroTitle" class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                                        Waroeng Bung Rakha
                                    </h1>
                                    <p id="heroDescription" class="text-lg md:text-xl text-blue-50 leading-relaxed max-w-lg">
                                        Tempat terbaik untuk bertransaksi barang dengan mudah, aman, dan terpercaya. Bergabunglah dengan ribuan pengguna yang telah mempercayai kami.
                                    </p>
                                </div>

                                <!-- Read More Button -->
                                <a id="heroButton" href="#keunggulan" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-300 font-semibold shadow-lg transform hover:-translate-y-0.5">
                                    <span>Read More</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <!-- Progress Dots -->
                                <div id="progressDots" class="flex gap-2 pt-4">
                                    <div class="w-12 h-1 bg-white rounded-full"></div>
                                    <div class="w-8 h-1 bg-white/40 rounded-full"></div>
                                    <div class="w-8 h-1 bg-white/40 rounded-full"></div>
                                </div>
                            </div>

                            <!-- Right Content - Illustration/Image Placeholder -->
                            <div class="relative hidden md:flex items-center justify-center animate-fade-in-up delay-200">
                                <div class="relative w-full max-w-md">
                                    <!-- Placeholder for character/illustration -->
                                    <div class="relative aspect-square">
                                        <!-- You can replace this with your character image -->
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-64 h-64 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/20">
                                                <svg class="w-32 h-32 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Decorative circles -->
                                        <div class="absolute top-0 right-0 w-20 h-20 bg-white/20 rounded-full blur-xl"></div>
                                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick CTA Buttons Below Hero -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up delay-300">
                        <a href="{{ route('login') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 font-semibold transform hover:-translate-y-0.5">
                            <span>Mulai Sekarang</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('about') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 border-2 border-gray-200 dark:border-gray-700 font-semibold shadow-lg transform hover:-translate-y-0.5">
                            <span>Pelajari Lebih Lanjut</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="keunggulan" class="py-20 bg-white dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                            Keunggulan Kami
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                            Mengapa memilih Waroeng Bung Rakha sebagai partner transaksi Anda
                        </p>
                    </div>

                    <!-- Feature Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1: Keamanan -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    Transaksi Aman
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Sistem keamanan berlapis untuk melindungi setiap transaksi Anda dengan enkripsi terkini
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2: Kecepatan -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    Proses Cepat
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Pengalaman transaksi yang efisien dengan sistem otomatis yang responsif dan real-time
                                </p>
                            </div>
                        </div>

                        <!-- Feature 3: Terpercaya -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    100% Terpercaya
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Dipercaya oleh ribuan pengguna dengan reputasi terbaik dalam layanan transaksi
                                </p>
                            </div>
                        </div>

                        <!-- Feature 4: Customer Support -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    Support 24/7
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Tim customer support siap membantu Anda kapan saja dengan respon yang cepat dan profesional
                                </p>
                            </div>
                        </div>

                        <!-- Feature 5: User Friendly -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    Mudah Digunakan
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Interface yang intuitif dan user-friendly memudahkan siapa saja untuk bertransaksi
                                </p>
                            </div>
                        </div>

                        <!-- Feature 6: Update -->
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    Selalu Update
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Platform yang terus berkembang dengan fitur-fitur terbaru untuk pengalaman terbaik
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 bg-gradient-to-br from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                        Siap Memulai Transaksi?
                    </h2>
                    <p class="text-lg text-blue-100 mb-10 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan pengguna yang telah mempercayai Waroeng Bung Rakha
                    </p>
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-600 rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-xl hover:shadow-2xl font-semibold transform hover:-translate-y-0.5">
                        <span>Hubungi Kami</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Footer Top -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                    <!-- Brand Section -->
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="text-white" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5m2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">Waroeng Bung Rakha</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md leading-relaxed">
                            Platform transaksi terpercaya untuk memenuhi kebutuhan Anda dengan mudah, aman, dan profesional.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 uppercase tracking-wider">Menu</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#home" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#keunggulan" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Keunggulan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Kontak
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 uppercase tracking-wider">Resources</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="https://laravel.com/docs" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Documentation
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/laravel/laravel" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    GitHub
                                </a>
                            </li>
                            <li>
                                <a href="https://laravel.com/docs/contributions" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    Contributing
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="pt-8 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <!-- Copyright -->
                        <div class="text-sm text-gray-600 dark:text-gray-400 text-center md:text-left">
                            <p>&copy; {{ date('Y') }} Waroeng Bung Rakha. All rights reserved.</p>
                            <p class="text-xs mt-1 text-gray-500 dark:text-gray-500">Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} • PHP v{{ PHP_VERSION }}</p>
                        </div>

                        <!-- Social Media Links -->
                        <div class="flex items-center gap-3">
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-200 transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-blue-400 hover:text-white dark:hover:bg-blue-400 dark:hover:text-white transition-all duration-200 transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-pink-500 hover:text-white dark:hover:bg-pink-500 dark:hover:text-white transition-all duration-200 transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Hero Slider Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Hero Slider Configuration
                const slides = [
                    {
                        badge: 'Waroeng Bung Rakha',
                        title: 'Waroeng Bung Rakha',
                        description: 'Tempat terbaik untuk bertransaksi barang dengan mudah, aman, dan terpercaya. Bergabunglah dengan ribuan pengguna yang telah mempercayai kami.',
                        buttonText: 'Read More',
                        buttonLink: '#keunggulan'
                    },
                    {
                        badge: 'Transaksi Mudah',
                        title: 'Transaksi Jadi Lebih Mudah',
                        description: 'Sistem yang user-friendly dan intuitif membuat setiap transaksi Anda menjadi lebih cepat dan efisien. Nikmati pengalaman berbelanja yang menyenangkan.',
                        buttonText: 'Pelajari Lebih Lanjut',
                        buttonLink: '{{ route("about") }}'
                    },
                    {
                        badge: 'Keamanan Terjamin',
                        title: 'Keamanan adalah Prioritas',
                        description: 'Dengan sistem keamanan berlapis dan enkripsi terkini, setiap transaksi Anda dijamin aman. Kepercayaan Anda adalah yang utama bagi kami.',
                        buttonText: 'Hubungi Kami',
                        buttonLink: '{{ route("contact") }}'
                    }
                ];

                let currentSlide = 0;
                const heroContent = document.getElementById('heroContent');
                const prevBtn = document.getElementById('prevSlide');
                const nextBtn = document.getElementById('nextSlide');
                const progressDots = document.getElementById('progressDots');

                // Update slide content
                function updateSlide(index) {
                    const slide = slides[index];
                    
                    // Add fade out animation
                    heroContent.style.opacity = '0';
                    heroContent.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        // Update content
                        document.getElementById('heroBadge').textContent = slide.badge;
                        document.getElementById('heroTitle').textContent = slide.title;
                        document.getElementById('heroDescription').textContent = slide.description;
                        document.getElementById('heroButton').textContent = slide.buttonText;
                        document.getElementById('heroButton').href = slide.buttonLink;
                        
                        // Update progress dots
                        updateProgressDots(index);
                        
                        // Add fade in animation
                        heroContent.style.opacity = '1';
                        heroContent.style.transform = 'translateX(0)';
                    }, 300);
                }

                // Update progress dots
                function updateProgressDots(index) {
                    progressDots.innerHTML = '';
                    slides.forEach((_, i) => {
                        const dot = document.createElement('div');
                        dot.className = i === index 
                            ? 'w-12 h-1 bg-white rounded-full transition-all duration-300' 
                            : 'w-8 h-1 bg-white/40 rounded-full transition-all duration-300 cursor-pointer hover:bg-white/60';
                        
                        dot.addEventListener('click', () => {
                            currentSlide = i;
                            updateSlide(currentSlide);
                        });
                        
                        progressDots.appendChild(dot);
                    });
                }

                // Previous slide
                prevBtn.addEventListener('click', () => {
                    currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
                    updateSlide(currentSlide);
                });

                // Next slide
                nextBtn.addEventListener('click', () => {
                    currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                    updateSlide(currentSlide);
                });

                // Auto slide every 5 seconds
                let autoSlideInterval = setInterval(() => {
                    currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                    updateSlide(currentSlide);
                }, 5000);

                // Pause auto slide on hover
                const heroSection = document.querySelector('#home .rounded-3xl');
                heroSection.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                heroSection.addEventListener('mouseleave', () => {
                    autoSlideInterval = setInterval(() => {
                        currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                        updateSlide(currentSlide);
                    }, 5000);
                });

                // Initialize progress dots
                updateProgressDots(0);

                // Add smooth transition style
                heroContent.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            });
        </script>

    </body>
</html>