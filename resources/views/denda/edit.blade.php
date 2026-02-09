<x-layouts::app :title="'Edit Denda'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('denda.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Denda</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('denda.update', $denda) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="id_pengembalian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengembalian</label>
                        <select name="id_pengembalian" id="id_pengembalian"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih Pengembalian</option>
                            @foreach($pengembalian as $item)
                                <option value="{{ $item->id }}" {{ old('id_pengembalian', $denda->id_pengembalian) == $item->id ? 'selected' : '' }}>
                                    {{ $item->peminjaman->user->name }} - {{ $item->peminjaman->alat->nama_alat }} ({{ $item->hari_terlambat }} hari terlambat)
                                </option>
                            @endforeach
                        </select>
                        @error('id_pengembalian')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                        <select name="id_user" id="id_user"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user', $denda->id_user) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $denda->nama_kategori) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('nama_kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="total_denda" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Denda</label>
                        <input type="number" name="total_denda" id="total_denda" value="{{ old('total_denda', $denda->total_denda) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required min="0">
                        @error('total_denda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="menunggu" {{ old('status', $denda->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="selesai" {{ old('status', $denda->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('denda.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>