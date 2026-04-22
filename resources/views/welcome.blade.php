<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nautica — Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased flex flex-col min-h-screen bg-slate-50 text-slate-900 overflow-x-hidden"
      style="font-family: 'Plus Jakarta Sans', sans-serif;">


    {{-- ════════════════════════════
         NAVIGASI
    ════════════════════════════ --}}
    <nav class="bg-white/80 backdrop-blur-xl sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center h-14">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2">
                    <span class="w-6 h-6 bg-slate-900 rounded-md flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </span>
                    <span class="text-sm font-black tracking-tight text-slate-900 uppercase">Nautica Library</span>
                </a>

                {{-- Auth --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-4 py-1.5 bg-slate-900 text-white text-xs font-bold rounded-full hover:bg-slate-700 transition-colors duration-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-xs font-semibold text-slate-500 hover:text-slate-900 transition-colors duration-200">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-1.5 bg-slate-900 text-white text-xs font-bold rounded-full hover:bg-slate-700 transition-colors duration-200 shadow-md shadow-slate-900/10">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <main class="flex-grow">

        {{-- ════════════════════════════
             HERO (compact — pas layar laptop)
        ════════════════════════════ --}}
        <section class="max-w-6xl mx-auto px-6 pt-4 pb-6">
            <div class="relative bg-slate-900 rounded-2xl overflow-hidden max-h-[420px]">

                {{-- Background image --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-[0.18]"
                    style="background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&q=80&w=2070');">
                </div>

                {{-- Grid 2 kolom --}}
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2">

                    {{-- Kiri: teks + CTA --}}
                    <div class="flex flex-col justify-between p-7 md:p-10">

                        {{-- Badge --}}
                        <span class="inline-flex items-center gap-2 self-start bg-white/10 border border-white/15
                                     text-white/60 text-[10px] font-bold uppercase tracking-widest
                                     px-3 py-1.5 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                            Nautica Library 
                        </span>

                        {{-- Headline + CTA --}}
                        <div class="mt-6">
                            <h1 class="text-4xl md:text-[2.6rem] font-black text-white leading-tight tracking-tighter mb-3">
                                Baca Lebih<br>
                                <span class="text-slate-400">Banyak.</span>
                                Belajar<br>Lebih Jauh.
                            </h1>
                            <p class="text-white/45 text-xs font-medium max-w-xs mb-5 leading-relaxed">
                                Ribuan koleksi buku tersedia kapan saja — gratis untuk seluruh siswa.
                            </p>

                            <div class="flex flex-wrap gap-2">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-900
                                              text-xs font-bold rounded-full hover:bg-slate-100 transition-colors duration-200">
                                        Jelajahi Koleksi
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-900
                                              text-xs font-bold rounded-full hover:bg-slate-100 transition-colors duration-200">
                                        Mulai Membaca
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('login') }}"
                                       class="inline-flex items-center px-5 py-2.5 border border-white/20
                                              text-white/65 text-xs font-semibold rounded-full
                                              hover:border-white/40 hover:text-white transition-colors duration-200">
                                        Sudah punya akun?
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: dekorasi visual --}}
                    <div class="hidden md:flex items-center justify-center p-8 relative">
                        <div class="relative w-40 h-52">
                            <div class="absolute -right-3 top-4 w-34 h-46 bg-white/5 border border-white/10 rounded-xl rotate-6"></div>
                            <div class="absolute -right-1 top-2 w-34 h-46 bg-white/5 border border-white/10 rounded-xl rotate-3"></div>
                            <div class="absolute inset-0 w-34 h-46 bg-white/10 border border-white/20 rounded-xl flex flex-col justify-between p-4">
                                <div class="space-y-1.5">
                                    <div class="w-8 h-1 bg-white/40 rounded-full"></div>
                                    <div class="w-12 h-1 bg-white/20 rounded-full"></div>
                                </div>
                                <div class="space-y-1">
                                    <div class="w-full h-1 bg-white/10 rounded-full"></div>
                                    <div class="w-full h-1 bg-white/10 rounded-full"></div>
                                    <div class="w-3/4 h-1 bg-white/10 rounded-full"></div>
                                </div>
                                <div class="flex justify-between items-end">
                                    <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest">Nautica</div>
                                    <div class="w-5 h-5 bg-white/10 rounded-full flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-white/40" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="absolute bottom-7 right-8 text-white/15 text-[9px] font-black uppercase tracking-[0.3em]">Est. 2024</span>
                    </div>

                </div>
            </div>
        </section>


        {{-- ════════════════════════════
             TICKER
        ════════════════════════════ --}}
        <div class="overflow-hidden whitespace-nowrap py-4 border-y border-slate-100 bg-white">
            <div id="ticker-track" class="inline-flex">
                @php
                    $tickerItems = ['Fiksi & Sastra','Sains & Teknologi','Sejarah & Budaya','Pengembangan Diri','Matematika','Bahasa & Komunikasi','Desain & Kreativitas','Bisnis & Kewirausahaan','Kesehatan','Referensi Kurikulum'];
                    $ticker = array_merge($tickerItems, $tickerItems);
                @endphp
                @foreach ($ticker as $item)
                    <span class="mx-8 text-[10px] font-bold text-slate-300 uppercase tracking-[0.25em]">{{ $item }}</span>
                    <span class="mx-2 text-slate-200">✦</span>
                @endforeach
            </div>
        </div>


        {{-- ════════════════════════════
             FITUR
        ════════════════════════════ --}}
        <section class="max-w-6xl mx-auto px-6 py-16">

            <div class="mb-12 js-reveal opacity-0 translate-y-6 transition-all duration-700">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.35em] mb-3">Mengapa Nautica?</p>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight max-w-lg">
                    Semua yang kamu butuhkan ada di sini.
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="js-reveal opacity-0 translate-y-6 transition-all duration-700 delay-75
                            bg-white border border-slate-100 rounded-2xl p-6 flex flex-col gap-4
                            hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/70">
                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900 mb-1.5">Katalog Cerdas</h3>
                        <p class="text-slate-400 text-xs leading-relaxed">
                            Temukan buku dalam hitungan detik berdasarkan judul, pengarang, atau kategori.
                        </p>
                    </div>
                </div>

                <div class="js-reveal opacity-0 translate-y-6 transition-all duration-700 delay-150
                            bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col gap-4
                            hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-900/20">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-white mb-1.5">Kemudahan Meminjam</h3>
                        <p class="text-slate-400 text-xs leading-relaxed">
                            Proses peminjaman buku menjadi lebih mudah dan cepat.
                        </p>
                    </div>
                </div>

                <div class="js-reveal opacity-0 translate-y-6 transition-all duration-700 delay-300
                            bg-white border border-slate-100 rounded-2xl p-6 flex flex-col gap-4
                            hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/70">
                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900 mb-1.5">Berbagai Buku Menarik</h3>
                        <p class="text-slate-400 text-xs leading-relaxed">
                            Temukan berbagai macam buku menarik yang sesuai dengan minat dan kebutuhanmu.
                        </p>
                    </div>
                </div>

            </div>
        </section>


        {{-- ════════════════════════════
             CTA BANNER
        ════════════════════════════ --}}
        <section class="max-w-6xl mx-auto px-6 pb-16">
            <div class="js-reveal opacity-0 translate-y-6 transition-all duration-700
                        bg-slate-100 rounded-2xl px-8 md:px-12 py-10
                        flex flex-col md:flex-row items-center justify-between gap-5">
                <div>
                    <h3 class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight mb-1">
                        Siap meminjam buku hari ini?
                    </h3>
                    <p class="text-slate-500 text-xs font-medium">Gratis untuk seluruh siswa aktif SMK Angkasa.</p>
                </div>
                @guest
                    <a href="{{ route('register') }}"
                       class="flex-shrink-0 inline-flex items-center gap-2 px-7 py-3 bg-slate-900 text-white
                              text-xs font-bold rounded-full hover:bg-slate-700 transition-colors duration-200
                              shadow-lg shadow-slate-900/10 whitespace-nowrap">
                        Daftar Sekarang
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @endguest
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="flex-shrink-0 inline-flex items-center gap-2 px-7 py-3 bg-slate-900 text-white
                              text-xs font-bold rounded-full hover:bg-slate-700 transition-colors duration-200
                              shadow-lg shadow-slate-900/10 whitespace-nowrap">
                        Buka Dashboard
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @endauth
            </div>
        </section>

    </main>


    {{-- ════════════════════════════
         FOOTER
    ════════════════════════════ --}}
    <footer class="border-t border-slate-100 bg-white">
        <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="w-5 h-5 bg-slate-900 rounded flex items-center justify-center">
                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                </span>
                <span class="text-xs font-black text-slate-900 uppercase tracking-tight">Nautica</span>
            </div>
            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} SMK Angkasa — Unit Literasi Digital
            </p>
        </div>
    </footer>


    {{-- ════════════════════════════
         SCRIPTS
    ════════════════════════════ --}}
    <script>
        // ── 1. Ticker marquee — pure JS / requestAnimationFrame ──────────────
        (function () {
            var track = document.getElementById('ticker-track');
            if (!track) return;
            var pos = 0, speed = 0.45, paused = false;
            track.parentElement.addEventListener('mouseenter', function () { paused = true; });
            track.parentElement.addEventListener('mouseleave', function () { paused = false; });
            function tick() {
                if (!paused) {
                    pos -= speed;
                    var half = track.scrollWidth / 2;
                    if (Math.abs(pos) >= half) pos = 0;
                    track.style.transform = 'translateX(' + pos + 'px)';
                }
                requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        })();

        // ── 2. Scroll reveal — IntersectionObserver + Tailwind classes ───────
        (function () {
            var els = document.querySelectorAll('.js-reveal');
            if (!els.length) return;
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        e.target.classList.remove('opacity-0', 'translate-y-6');
                        e.target.classList.add('opacity-100', 'translate-y-0');
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12 });
            els.forEach(function (el) { io.observe(el); });
        })();
    </script>

</body>
</html>