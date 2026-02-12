<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Preview Transaksi
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('d F Y, H:i') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Summary Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-8 mb-6 shadow-xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Total Item
                        </p>
                        <h3 class="text-4xl font-bold">{{ count($items) }}</h3>
                        <p class="text-blue-100 text-xs mt-1">Item dipilih</p>
                    </div>

                    <div class="text-right">
                        <p class="text-blue-100 text-sm mb-1 flex items-center justify-end gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Total Pembayaran
                        </p>

                        @if(isset($totalDiskon) && $totalDiskon > 0)
                            <h3 class="text-4xl font-bold">
                                Rp {{ number_format($totalAkhir, 0, ',', '.') }}
                            </h3>
                            <div class="mt-2 inline-flex items-center gap-1 px-3 py-1 bg-green-500 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-sm font-semibold">Hemat {{ $totalDiskon }}%</span>
                            </div>
                        @else
                            <h3 class="text-4xl font-bold">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </h3>
                        @endif
                    </div>

                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Detail Items -->
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

                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($items as $index => $item)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <!-- Item Number Badge -->
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <span class="text-blue-600 dark:text-blue-400 font-bold">{{ $index + 1 }}</span>
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-lg mb-1">
                                            {{ $item['nama'] }}
                                        </h4>

                                        @if($item['diskon'] > 0)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm line-through text-gray-400 dark:text-gray-500">
                                                    Rp {{ number_format($item['harga_asli'], 0, ',', '.') }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                    </svg>
                                                    -{{ $item['diskon'] }}%
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-right">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Subtotal</p>
                                        <p class="font-bold text-xl text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-white dark:bg-gray-800 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Harga Satuan</p>
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                Rp {{ number_format($item['harga_final'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-white dark:bg-gray-800 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah</p>
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $item['qty'] }} pcs
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total Summary -->
                <div class="px-6 py-6 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-900/50 dark:to-blue-900/20 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Item</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                {{ count($items) }} Barang
                            </p>
                        </div>

                        <div class="text-right space-y-2">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Sebelum Diskon</p>
                                <p class="{{ isset($totalDiskon) && $totalDiskon > 0 ? 'line-through text-gray-400 dark:text-gray-500 text-lg' : 'text-3xl font-bold text-blue-600 dark:text-blue-400' }}">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </p>
                            </div>

                            @if(isset($totalDiskon) && $totalDiskon > 0)
                                <div class="flex items-center justify-end gap-2 px-3 py-1.5 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-green-700 dark:text-green-400 font-semibold">
                                        Diskon {{ $totalDiskon }}% 
                                        (- Rp {{ number_format($potongan, 0, ',', '.') }})
                                    </span>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Akhir</p>
                                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                        Rp {{ number_format($totalAkhir, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('transaksi.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors border border-gray-200 dark:border-gray-600 font-medium shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    @foreach($items as $item)
                        <input type="hidden" name="barang_id[]" value="{{ $item['id'] }}">
                        <input type="hidden" name="qty[{{ $item['id'] }}]" value="{{ $item['qty'] }}">
                    @endforeach
                    
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Konfirmasi Transaksi
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>