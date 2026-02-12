<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Kategori
                        </label>
                        <input type="text"
                               name="nama_kategori"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                               required>
                    </div>

                    <div class="flex justify-end gap-3">

                        <a href="{{ route('kategori.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow-md">
                            Update
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
