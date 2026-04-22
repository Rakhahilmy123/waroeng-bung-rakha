<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Tambah Buku</h2>
            </div>
            <a href="{{ route('buku.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all duration-200 border border-slate-200 shadow-sm font-bold text-xs uppercase tracking-widest">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Info Banner --}}
            <div class="flex items-start gap-3 bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-0.5">Petunjuk</p>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Pastikan metadata buku (penulis & penerbit) diverifikasi sesuai fisik buku untuk akurasi database perpustakaan digital.
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Tambah Buku Baru</p>
                        <p class="text-[10px] text-slate-400 font-medium">Isi semua field yang wajib diisi</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    {{-- Judul Buku --}}
                    <div>
                        <label for="judul" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Judul Buku <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="judul_buku" id="judul" value="{{ old('judul_buku') }}" required
                               class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 transition-all text-sm font-medium"
                               placeholder="Masukkan judul buku lengkap...">
                        @error('judul_buku')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label for="kategori_id" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Kategori <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="kategori_id" id="kategori_id" required
                                    class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 appearance-none cursor-pointer text-sm font-medium">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        @error('kategori_id')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Penulis & Penerbit --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="penulis" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Penulis <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 transition-all text-sm font-medium"
                                   placeholder="Nama lengkap penulis">
                            @error('penulis')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="penerbit" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Penerbit <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 transition-all text-sm font-medium"
                                   placeholder="Nama perusahaan penerbit">
                            @error('penerbit')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Stok & Gambar --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="stok" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Stok <span class="text-red-400">*</span>
                            </label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok', 1) }}" min="1" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 transition-all text-sm font-black">
                            @error('stok')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="gambar" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Sampul Buku <span class="text-slate-300 font-medium normal-case tracking-normal">(opsional)</span>
                            </label>
                            <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/jpg"
                                   class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl text-slate-500 text-sm
                                          file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0
                                          file:text-[10px] file:font-black file:uppercase file:tracking-wide
                                          file:bg-slate-900 file:text-white hover:file:bg-slate-700
                                          transition-all cursor-pointer">
                            <p class="mt-1.5 text-[10px] text-slate-400 font-medium">Format: JPG, PNG · Maks: 2MB</p>
                            
                            {{-- Preview gambar --}}
                            <div id="preview-container" class="mt-3 hidden">
                                <img id="preview-image" class="h-24 w-auto object-cover rounded-lg border border-slate-200 shadow-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-100 pt-5">
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-black text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Buku
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    {{-- Script preview gambar --}}
    <script>
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                previewImage.src = '';
            }
        });
    </script>
</x-app-layout>