<x-layouts::app :title="'Tambah Pengembalian'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('pengembalian.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Pengembalian</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('pengembalian.store') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="id_peminjaman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih Peminjaman</option>
                            @foreach($peminjaman as $item)
                                <option value="{{ $item->id }}" {{ old('id_peminjaman') == $item->id ? 'selected' : '' }}>
                                    {{ $item->user->name }} - {{ $item->alat->nama_alat }} ({{ $item->alat->kategori->nama_kategori }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_peminjaman')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_kembali_realisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Kembali Realisasi</label>
                        <input type="date" name="tanggal_kembali_realisasi" id="tanggal_kembali_realisasi" value="{{ old('tanggal_kembali_realisasi') }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('tanggal_kembali_realisasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User yang Mengembalikan</label>
                        <select name="id_user" id="id_user"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('pengembalian.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
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