<x-layouts::app :title="'Edit Pembayaran'">
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Back Button & Title -->
        <div class="flex items-center gap-4">
            <a href="{{ route('payment.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Pembayaran</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('payment.update', $payment) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="id_denda" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Denda</label>
                        <select name="id_denda" id="id_denda"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                            <option value="">Pilih Denda</option>
                            @foreach($denda as $item)
                                <option value="{{ $item->id }}" {{ old('id_denda', $payment->id_denda) == $item->id ? 'selected' : '' }}>
                                    {{ $item->pengembalian->peminjaman->user->name }} - {{ $item->nama_kategori }} (Rp {{ number_format($item->total_denda) }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_denda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nominal" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nominal Pembayaran</label>
                        <input type="number" name="nominal" id="nominal" value="{{ old('nominal', $payment->nominal) }}"
                               class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required min="0">
                        @error('nominal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="proof_img" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bukti Pembayaran</label>
                        <input type="file" name="proof_img" id="proof_img" accept="image/*"
                               class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload gambar bukti pembayaran baru (JPEG, PNG, JPG, GIF, max 2MB). Kosongkan jika tidak ingin mengubah.</p>
                        @if($payment->proof_img)
                            <p class="mt-1 text-sm text-green-600">Bukti saat ini: <a href="{{ Storage::url($payment->proof_img) }}" target="_blank" class="underline">Lihat</a></p>
                        @endif
                        @error('proof_img')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" id="status"
                                class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                            <option value="menunggu" {{ old('status', $payment->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ old('status', $payment->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ old('status', $payment->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('payment.index') }}" class="inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors">
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