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
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                  required>{{ old('deskripsi', $log_aktivitas->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_user" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">User</label>
                        <select name="id_user" id="id_user"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                        <label for="jenis_aktivitas" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jenis Aktivitas</label>
                        <select name="jenis_aktivitas" id="jenis_aktivitas"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                        <label for="tanggal_aktivitas" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tanggal Aktivitas</label>
                        <input type="date" name="tanggal_aktivitas" id="tanggal_aktivitas" value="{{ old('tanggal_aktivitas', $log_aktivitas->tanggal_aktivitas->format('Y-m-d')) }}"
                               class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required>
                        @error('tanggal_aktivitas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('log-aktivitas.index') }}" class="inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>