<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">
                    Edit User
                </h2>
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="name"value="{{ old('name', $user->name) }}" class="w-full rounded border-gray-300"required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full rounded border-gray-300"
                            required>
                    </div>

                    {{-- Role --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Role</label>
                        <select name="role" class="w-full rounded border-gray-300" required>
                            <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>
                                Superadmin
                            </option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>
                                Operator
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('users.index') }}"
                        class="px-4 py-2 bg-gray-300 rounded">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>