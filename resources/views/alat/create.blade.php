<x-layouts::app :title="'Tambah Alat'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('alat.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Alat</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('alat.store') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                        <select name="id_kategori" id="id_kategori"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}" {{ old('id_kategori') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Alat</label>
                        <input type="text" name="nama_alat" id="nama_alat" value="{{ old('nama_alat') }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('nama_alat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="tersedia" {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak_tersedia" {{ old('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('alat.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>