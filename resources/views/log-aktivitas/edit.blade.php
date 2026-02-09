<x-layouts::app :title="'Edit Log Aktivitas'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('log-aktivitas.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Log Aktivitas</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('log-aktivitas.update', $log_aktivitas) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  required>{{ old('deskripsi', $log_aktivitas->deskripsi) }}</textarea>
                        @error('deskripsi')
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
                                <option value="{{ $user->id }}" {{ old('id_user', $log_aktivitas->id_user) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_aktivitas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Aktivitas</label>
                        <select name="jenis_aktivitas" id="jenis_aktivitas"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option value="peminjaman" {{ old('jenis_aktivitas', $log_aktivitas->jenis_aktivitas) == 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                            <option value="pengembalian" {{ old('jenis_aktivitas', $log_aktivitas->jenis_aktivitas) == 'pengembalian' ? 'selected' : '' }}>Pengembalian</option>
                            <option value="denda" {{ old('jenis_aktivitas', $log_aktivitas->jenis_aktivitas) == 'denda' ? 'selected' : '' }}>Denda</option>
                            <option value="payment" {{ old('jenis_aktivitas', $log_aktivitas->jenis_aktivitas) == 'payment' ? 'selected' : '' }}>Payment</option>
                        </select>
                        @error('jenis_aktivitas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_aktivitas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Aktivitas</label>
                        <input type="date" name="tanggal_aktivitas" id="tanggal_aktivitas" value="{{ old('tanggal_aktivitas', $log_aktivitas->tanggal_aktivitas->format('Y-m-d')) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('tanggal_aktivitas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('log-aktivitas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
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