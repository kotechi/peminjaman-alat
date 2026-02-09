<x-layouts::app :title="'Tambah Pengembalian'">
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Back Button & Title -->
        <div class="flex items-center gap-4">
            <a href="{{ route('pengembalian.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah Pengembalian</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('pengembalian.store') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="id_peminjaman" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                        <label for="tanggal_kembali_realisasi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tanggal Kembali Realisasi</label>
                        <input type="date" name="tanggal_kembali_realisasi" id="tanggal_kembali_realisasi" value="{{ old('tanggal_kembali_realisasi') }}"
                               class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required>
                        @error('tanggal_kembali_realisasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @if(auth()->user()->isAdmin() or auth()->user()->isPetugas())
                    <div>
                        <label for="id_user" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">User yang Mengembalikan</label>
                        <select name="id_user" id="id_user"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                    @endif

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('pengembalian.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold shadow-sm transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>