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
            <div class="bg-blue-500 rounded-2xl p-8 mb-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm mb-1">Total Item</p>
                        <h3 class="text-4xl font-bold">{{ count($items) }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-sm mb-1">Total Pembayaran</p>
                        <h3 class="text-4xl font-bold">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Detail Barang
                    </h3>
                </div>

                <!-- Items List -->
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($items as $item)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">
                                            {{ $item['nama'] }}
                                        </h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            @if($item['diskon'] > 0)
                                                <span class="text-sm text-gray-400 dark:text-gray-500 line-through">
                                                    Rp {{ number_format($item['harga_asli'], 0, ',', '.') }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                    -{{ $item['diskon'] }}%
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-4 mt-3 text-sm">
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Harga Satuan</p>
                                        <p class="font-semibold text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($item['harga_final'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Jumlah</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $item['qty'] }} pcs
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-500 dark:text-gray-400">Subtotal</p>
                                        <p class="font-bold text-lg text-gray-900 dark:text-white">
                                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total Summary -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Item</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ count($items) }} Barang</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('transaksi.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border border-gray-200 dark:border-gray-700 font-medium shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    @foreach($items as $item)
                        <input type="hidden" name="barang_id[]" value="{{ $item['id'] }}">
                        <input type="hidden" name="qty[]" value="{{ $item['qty'] }}">
                    @endforeach
                    
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Konfirmasi Transaksi
                    </button>
                </form>
            </div>

            <!-- Info Note -->
            <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-900 dark:text-blue-300 mb-1">Informasi</h4>
                        <p class="text-sm text-blue-800 dark:text-blue-400">
                            Pastikan detail transaksi sudah benar sebelum konfirmasi. Setelah dikonfirmasi, stok barang akan otomatis berkurang.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>