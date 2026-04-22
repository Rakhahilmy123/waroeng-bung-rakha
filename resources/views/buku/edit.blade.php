<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-1">Management Perpustakaan</p>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Edit Buku</h2>
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
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-0.5">Informasi</p>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Anda sedang mengubah data buku: <span class="font-black text-slate-700">{{ $buku->judul_buku }}</span>.
                        Kosongkan field gambar jika tidak ingin mengganti cover.
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-slate-900">Update Data Buku</p>
                        <p class="text-[10px] text-slate-400 font-medium">Perbarui informasi koleksi di bawah</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form method="POST" action="{{ route('buku.update', $buku) }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Judul Buku --}}
                    <div>
                        <label for="judul_buku" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Judul Buku <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="judul_buku" id="judul_buku"
                               value="{{ old('judul_buku', $buku->judul_buku) }}" required
                               class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                      @error('judul_buku') border-red-300 @enderror"
                               placeholder="Masukkan judul buku...">
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
                                    class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 appearance-none cursor-pointer text-sm font-medium transition-all">
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $buku->kategori_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
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
                            <input type="text" name="penulis" id="penulis"
                                   value="{{ old('penulis', $buku->penulis) }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('penulis') border-red-300 @enderror"
                                   placeholder="Nama penulis...">
                            @error('penulis')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="penerbit" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                                Penerbit <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="penerbit" id="penerbit"
                                   value="{{ old('penerbit', $buku->penerbit) }}" required
                                   class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 placeholder-slate-400 text-sm font-medium transition-all
                                          @error('penerbit') border-red-300 @enderror"
                                   placeholder="Nama penerbit...">
                            @error('penerbit')
                                <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stok" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Jumlah Stok <span class="text-red-400">*</span>
                        </label>
                        <input type="number" name="stok" id="stok"
                               value="{{ old('stok', $buku->stok) }}" min="0" required
                               class="w-full px-4 py-3 bg-[#F1F5F9] border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 text-slate-900 text-sm font-black transition-all
                                      @error('stok') border-red-300 @enderror">
                        @error('stok')
                            <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sampul Buku --}}
                    <div>
                        <label for="gambar" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-1.5">
                            Sampul Buku <span class="text-slate-300 font-medium normal-case tracking-normal">(opsional)</span>
                        </label>

                        @php
                            $hasOldCover = !empty($buku->gambar)
                                && \Illuminate\Support\Facades\Storage::disk('public')->exists($buku->gambar);
                        @endphp

                        {{-- Cover saat ini --}}
                        @if($hasOldCover)
                        <div class="flex items-center gap-3 bg-[#F1F5F9] border border-slate-200 rounded-xl p-3 mb-3">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($buku->gambar) }}"
                                 alt="Cover saat ini"
                                 class="h-16 w-12 object-cover rounded-lg border border-slate-200 shadow-sm shrink-0">
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-0.5">Cover Saat Ini</p>
                                <p class="text-xs text-slate-400 font-medium">Upload gambar baru untuk mengganti cover ini.</p>
                            </div>
                        </div>
                        @endif

                        {{-- Input file --}}
                        <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/jpg"
                               class="w-full px-4 py-2.5 bg-[#F1F5F9] border border-slate-200 rounded-xl text-slate-500 text-sm
                                      file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0
                                      file:text-[10px] file:font-black file:uppercase file:tracking-wide
                                      file:bg-slate-900 file:text-white hover:file:bg-slate-700
                                      transition-all cursor-pointer">
                        <p class="mt-1.5 text-[10px] text-slate-400 font-medium">Format: JPG, PNG · Maks: 2MB</p>

                        {{-- Preview gambar baru --}}
                        <div id="preview-container" class="hidden mt-3">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Preview Cover Baru</p>
                            <img id="preview-image"
                                 class="h-20 w-auto object-cover rounded-xl border border-slate-200 shadow-sm">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all duration-200 shadow-sm font-bold text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('buku.index') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-white text-slate-600 rounded-xl hover:bg-slate-100 transition-all duration-200 border border-slate-200 font-bold text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>

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