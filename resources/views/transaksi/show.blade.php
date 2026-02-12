<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Detail Transaksi #{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $transaksi->created_at->format('d F Y, H:i') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Info Transaksi Card --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-8 mb-6 shadow-xl text-white">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <p class="text-blue-100 text-sm mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            ID Transaksi
                        </p>
                        <p class="text-2xl font-bold">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Tanggal & Waktu
                        </p>
                        <p class="text-lg font-semibold">{{ $transaksi->created_at->format('d/m/Y') }}</p>
                        <p class="text-blue-100 text-sm">{{ $transaksi->created_at->format('H:i') }} WIB</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Operator
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-semibold">
                                {{ strtoupper(substr($transaksi->user->name, 0, 1)) }}
                            </div>
                            <p class="text-lg font-semibold">{{ $transaksi->user->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-sm mb-1 flex items-center justify-end gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Total Transaksi
                        </p>
                        @php
                            $totalSebelumDiskon = $transaksi->details->sum('subtotal');
                            // Hitung total tanpa diskon transaksi (hanya pakai diskon item)
                            if ($transaksi->diskon > 0) {
                                $totalSebelumDiskon = $transaksi->total_harga / (1 - $transaksi->diskon / 100);
                            }
                        @endphp
                        
                        @if($transaksi->diskon > 0)
                            <p class="text-lg line-through text-blue-200">
                                Rp {{ number_format($totalSebelumDiskon, 0, ',', '.') }}
                            </p>
                            <p class="text-3xl font-bold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </p>
                            <div class="mt-2 inline-flex items-center gap-1 px-3 py-1 bg-green-500 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-sm font-semibold">Hemat {{ $transaksi->diskon }}%</span>
                            </div>
                        @else
                            <p class="text-3xl font-bold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Detail Item --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Detail Barang
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Harga Satuan</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Diskon Item</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transaksi->details as $detail)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold text-sm">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900 dark:text-white">
                                        {{ $detail->barang->nama_barang }}
                                    </div>
                                    @if($detail->diskon > 0)
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            Harga Normal:
                                        </span>
                                        <span class="text-xs line-through text-gray-400 dark:text-gray-500">
                                            Rp {{ number_format($detail->barang->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $detail->qty }} pcs
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($detail->diskon > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            -{{ $detail->diskon }}%
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="font-bold text-blue-600 dark:text-blue-400">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary dengan Diskon -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-900/50 dark:to-blue-900/20 border-t border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 space-y-2">
                        <!-- Total Sebelum Diskon Transaksi -->
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal Item:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                Rp {{ number_format($transaksi->details->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>

                        @if($transaksi->diskon > 0)
                        <!-- Diskon Transaksi -->
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Diskon Transaksi ({{ $transaksi->diskon }}%):
                            </span>
                            <span class="font-semibold text-green-600 dark:text-green-400">
                                - Rp {{ number_format($totalSebelumDiskon - $transaksi->total_harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-300 dark:border-gray-600 my-2"></div>
                        @endif

                        <!-- Total Akhir -->
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-base font-bold text-gray-900 dark:text-white uppercase">
                                Total Pembayaran:
                            </span>
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Statistics --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Ringkasan Transaksi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Item</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transaksi->details->count() }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Jenis Barang</p>
                    </div>
                    
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Quantity</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transaksi->details->sum('qty') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Pieces</p>
                    </div>
                    
                    <div class="text-center p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Diskon</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                            @if($transaksi->diskon > 0)
                                Rp {{ number_format($totalSebelumDiskon - $transaksi->total_harga, 0, ',', '.') }}
                            @else
                                Rp 0
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            {{ $transaksi->diskon > 0 ? $transaksi->diskon . '% Hemat' : 'Tidak Ada' }}
                        </p>
                    </div>

                    <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Dibayar</p>
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Total Akhir</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('transaksi.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border border-gray-200 dark:border-gray-700 font-medium shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Riwayat
                </a>

                <button onclick="window.print()" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-lg font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Struk
                </button>
            </div>

        </div>
    </div>
</x-app-layout>