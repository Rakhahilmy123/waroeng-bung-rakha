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
            <div class="bg-blue-500 rounded-2xl p-8 mb-6 shadow-lg text-white">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <p class="text-blue-100 text-sm mb-1">ID Transaksi</p>
                        <p class="text-2xl font-bold">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm mb-1">Tanggal & Waktu</p>
                        <p class="text-lg font-semibold">{{ $transaksi->created_at->format('d/m/Y') }}</p>
                        <p class="text-blue-100 text-sm">{{ $transaksi->created_at->format('H:i') }} WIB</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm mb-1">Operator</p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-semibold">
                                {{ strtoupper(substr($transaksi->user->name, 0, 1)) }}
                            </div>
                            <p class="text-lg font-semibold">{{ $transaksi->user->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-sm mb-1">Total Transaksi</p>
                        <p class="text-3xl font-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Detail Item --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Detail Barang
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga Satuan</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Diskon</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transaksi->details as $detail)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-semibold text-gray-900 dark:text-white">
                                        {{ $detail->barang->nama_barang }}
                                    </div>
                                    @if($detail->diskon > 0)
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Harga Normal: Rp {{ number_format($detail->barang->harga, 0, ',', '.') }}
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $detail->qty }} pcs
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-gray-900 dark:text-gray-300">
                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($detail->diskon > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                            -{{ $detail->diskon }}%
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-blue-600 dark:text-blue-400">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-right text-sm font-bold text-gray-900 dark:text-white uppercase">
                                    Total Pembayaran
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Summary Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                <div class="grid grid-cols-3 gap-6 text-center">
                    <div class="border-r border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Item</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transaksi->details->count() }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Jenis Barang</p>
                    </div>
                    <div class="border-r border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Quantity</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transaksi->details->sum('qty') }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Pieces</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Diskon</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                            @php
                                $totalNormal = $transaksi->details->sum(function($detail) {
                                    return $detail->qty * $detail->barang->harga;
                                });
                                $totalDiskon = $totalNormal - $transaksi->total_harga;
                            @endphp
                            Rp {{ number_format($totalDiskon, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Hemat</p>
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
                        class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Struk
                </button>
            </div>

        </div>
    </div>
</x-app-layout>