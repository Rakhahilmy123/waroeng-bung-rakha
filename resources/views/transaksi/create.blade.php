<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Buat Transaksi Baru
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('d F Y, H:i') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-green-800 dark:text-green-400">Berhasil!</h3>
                            <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <form method="POST" action="{{ route('transaksi.preview') }}" x-data="transaksiForm()" @submit="validateForm($event)">
                @csrf

                <!-- Cart Summary Card -->
                <div class="bg-blue-500  rounded-2xl p-6 mb-6 shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Total Item Dipilih</p>
                            <h3 class="text-3xl font-bold" x-text="selectedCount"></h3>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                

                <!-- Products List -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    
                    <!-- Table Header -->
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Pilih Barang
                        </h3>
                    </div>

                    <!-- Products Grid -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($barangs as $index => $barang)
                            <div class="relative group border-2 rounded-xl p-4 transition-all duration-200"
                                 :class="selectedItems.includes({{ $barang->id }}) ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-600'">
                                
                                <div class="flex items-start gap-4">
                                    <!-- Checkbox -->
                                    <div class="flex items-center h-5 mt-1">
                                        <input type="checkbox" 
                                               name="barang_id[]" 
                                               value="{{ $barang->id }}"
                                               @change="toggleItem({{ $barang->id }}, {{ $barang->harga_diskon ?? $barang->harga }})"
                                               class="w-5 h-5 text-blue-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">
                                                    {{ $barang->nama_barang }}
                                                </h4>
                                                <div class="flex items-center gap-2">
                                                    @if($barang->diskon > 0)
                                                        <span class="text-sm text-gray-400 dark:text-gray-500 line-through">
                                                            Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                                        </span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                            -{{ $barang->diskon }}%
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-1">
                                                    Rp {{ number_format($barang->harga_diskon ?? $barang->harga, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <!-- Stock Badge -->
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                {{ $barang->stok > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                                   ($barang->stok > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                                   'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                                Stok: {{ $barang->stok }}
                                            </span>
                                        </div>

                                        <!-- Quantity Input -->
                                        <div class="mt-3">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Jumlah
                                            </label>
                                            <div class="flex items-center gap-3">
                                                <button type="button"
                                                        @click="decreaseQty({{ $index }})"
                                                        class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                
                                                <input type="number" 
                                                       name="qty[]"
                                                       x-model="quantities[{{ $index }}]"
                                                       @input="updateTotal({{ $barang->id }}, {{ $barang->harga_diskon ?? $barang->harga }})"
                                                       min="0"
                                                       max="{{ $barang->stok }}"
                                                       placeholder="0"
                                                       class="w-20 text-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                
                                                <button type="button"
                                                        @click="increaseQty({{ $index }}, {{ $barang->stok }})"
                                                        class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>

                                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                                                    Max: {{ $barang->stok }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected Indicator -->
                                <div x-show="selectedItems.includes({{ $barang->id }})" 
                                     x-transition
                                     class="absolute top-2 right-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($barangs->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">
                                Tidak ada barang tersedia
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border border-gray-200 dark:border-gray-700 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Batal
                    </a>

                    <button type="submit" 
                            :disabled="selectedCount === 0"
                            :class="selectedCount === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:from-blue-600 hover:to-purple-700 hover:shadow-lg'"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-blue-500  text-white rounded-lg transition-all duration-200 shadow-md font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Proses Transaksi
                        <span x-show="selectedCount > 0" 
                              x-text="'(' + selectedCount + ' item)'"
                              class="ml-1 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function transaksiForm() {
            return {
                selectedItems: [],
                quantities: Array({{ $barangs->count() }}).fill(1),
                totalAmount: 0,
                
                get selectedCount() {
                    return this.selectedItems.length;
                },
                
                validateForm(event) {
                    if (this.selectedCount === 0) {
                        event.preventDefault();
                        alert('Pilih minimal 1 barang!');
                        return false;
                    }
                    
                    // Validasi qty untuk setiap item yang dipilih
                    const allCards = document.querySelectorAll('.relative.group');
                    let hasError = false;
                    
                    allCards.forEach((card) => {
                        const checkbox = card.querySelector('input[name="barang_id[]"]');
                        if (checkbox && checkbox.checked) {
                            const qtyInput = card.querySelector('input[name="qty[]"]');
                            const qty = parseInt(qtyInput.value) || 0;
                            
                            if (qty < 1) {
                                hasError = true;
                                alert('Jumlah barang harus minimal 1!');
                                event.preventDefault();
                                return false;
                            }
                        }
                    });
                    
                    return !hasError;
                },
                
                toggleItem(id, price) {
                    const index = this.selectedItems.indexOf(id);
                    if (index > -1) {
                        this.selectedItems.splice(index, 1);
                    } else {
                        this.selectedItems.push(id);
                    }
                    this.calculateTotal();
                },
                
                updateTotal(id, price) {
                    this.calculateTotal();
                },
                
                calculateTotal() {
                    let total = 0;
                    const allCards = document.querySelectorAll('.relative.group');
                    
                    allCards.forEach((card, index) => {
                        const checkbox = card.querySelector('input[name="barang_id[]"]');
                        if (checkbox && checkbox.checked) {
                            const qtyInput = card.querySelector('input[name="qty[]"]');
                            const qty = parseInt(qtyInput.value) || 1;
                            const priceElement = card.querySelector('.text-blue-600');
                            const priceText = priceElement.textContent.replace(/[^0-9]/g, '');
                            const price = parseInt(priceText);
                            
                            total += price * qty;
                        }
                    });
                    
                    this.totalAmount = total;
                },
                
                increaseQty(index, max) {
                    if (this.quantities[index] < max) {
                        this.quantities[index]++;
                        this.calculateTotal();
                    }
                },
                
                decreaseQty(index) {
                    if (this.quantities[index] > 1) {
                        this.quantities[index]--;
                        this.calculateTotal();
                    }
                },
                
                formatCurrency(amount) {
                    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }
        }
    </script>
</x-app-layout>