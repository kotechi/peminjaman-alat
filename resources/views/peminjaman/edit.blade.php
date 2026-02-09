<x-layouts::app :title="'Edit Peminjaman'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('peminjaman.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Peminjaman</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                        <select name="id_user" id="id_user"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user', $peminjaman->id_user) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alat</label>
                        <select name="id_alat" id="id_alat"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="">Pilih Alat</option>
                            @foreach($alat as $item)
                                <option value="{{ $item->id }}" {{ old('id_alat', $peminjaman->id_alat) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_alat }} ({{ $item->kategori->nama_kategori }}) - {{ ucfirst($item->status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_alat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_pengembalian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $peminjaman->tanggal_pengembalian->format('Y-m-d')) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        @error('tanggal_pengembalian')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="menunggu" {{ old('status', $peminjaman->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ old('status', $peminjaman->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ old('status', $peminjaman->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('peminjaman.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
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