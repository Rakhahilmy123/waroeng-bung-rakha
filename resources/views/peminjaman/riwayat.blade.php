<x-app-layout>
    <div class="min-h-screen bg-[#F1F5F9] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Pinjaman Saya
                    </h2>
                    <p class="text-sm font-medium text-slate-500 mt-2">
                        Daftar koleksi buku yang sedang kamu baca dan riwayat literasimu.
                    </p>
                </div>

                <a href="{{ route('peminjaman.index') }}" 
                   class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-2xl text-sm font-bold transition-all active:scale-95 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Pinjam Buku Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-white border-l-4 border-slate-900 text-slate-700 font-semibold rounded-r-2xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert keterlambatan (opsional) --}}
            @php
                $today = \Carbon\Carbon::today();
                $totalTerlambat = $peminjamans->filter(function($p) use ($today) {
                    return $p->status === 'dipinjam' && $today->gt(\Carbon\Carbon::parse($p->tanggal_kembali));
                })->count();
            @endphp
            @if($totalTerlambat > 0)
            <div class="mb-8 flex items-start gap-3 bg-white border-l-4 border-red-500 rounded-r-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-red-600 uppercase tracking-[0.2em] mb-0.5">Perhatian</p>
                    <p class="text-sm font-semibold text-red-700">
                        Anda memiliki <span class="font-black">{{ $totalTerlambat }} buku</span> yang melewati batas waktu pengembalian. 
                        Segera kembalikan ke perpustakaan untuk menghindari denda.
                    </p>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2.5rem] border border-white">
                <div class="p-2 md:p-10">
                    
                    <div class="flex gap-2 mb-10 p-1.5 bg-slate-100 w-fit rounded-2xl">
                        <a href="{{ route('peminjaman.riwayat', ['tab' => 'aktif']) }}" 
                           class="px-6 py-2.5 text-sm font-bold transition-all rounded-xl {{ request('tab') != 'riwayat' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                             Sedang Dipinjam
                        </a>
                        <a href="{{ route('peminjaman.riwayat', ['tab' => 'riwayat']) }}" 
                           class="px-6 py-2.5 text-sm font-bold transition-all rounded-xl {{ request('tab') == 'riwayat' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                            Riwayat Selesai
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-3">
                            <thead>
                                <tr class="text-slate-400 text-[11px] uppercase font-bold tracking-[0.2em]">
                                    <th class="px-6 py-4">Informasi Buku</th>
                                    <th class="px-6 py-4">Tanggal Pinjam</th>
                                    <th class="px-6 py-4">Batas Kembali</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                 </tr>
                            </thead>
                            <tbody class="text-slate-600">
                                @forelse ($peminjamans as $p)
                                @php
                                    $deadline = \Carbon\Carbon::parse($p->tanggal_kembali);
                                    $today = \Carbon\Carbon::today();
                                    $isLate = ($p->status === 'dipinjam' && $today->gt($deadline));
                                @endphp
                                <tr class="group bg-[#F8FAFC] hover:bg-slate-50 transition-all duration-300">
                                    <td class="px-6 py-5 rounded-l-[1.5rem]">
                                        <div class="font-bold text-slate-900 text-base capitalize">{{ $p->buku->judul_buku }}</div>
                                        <div class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-wider">ID: #{{ $p->id }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-semibold text-slate-700">
                                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            @if($p->status === 'dipinjam')
                                                <span class="text-sm font-bold {{ $isLate ? 'text-red-500' : 'text-slate-900' }}">
                                                    {{ $deadline->format('d/m/Y') }}
                                                </span>
                                                @if($isLate)
                                                    <span class="text-[9px] font-black text-red-400 uppercase tracking-wide mt-0.5">Terlambat</span>
                                                @endif
                                            @else
                                                <span class="text-sm font-bold text-emerald-600">
                                                    {{ \Carbon\Carbon::parse($p->tanggal_nyata_kembali ?? $p->updated_at)->format('d/m/Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center rounded-r-[1.5rem]">
                                        @if($p->status === 'dipinjam')
                                            <span class="inline-flex items-center px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest ring-1 ring-amber-100">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest ring-1 ring-emerald-100">
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center">
                                        <div class="flex flex-col items-center justify-center opacity-30">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <p class="text-lg font-bold">Belum ada aktivitas pinjaman.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-10 px-2">
                        {{ $peminjamans->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>