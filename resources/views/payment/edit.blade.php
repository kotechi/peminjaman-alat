<x-layouts::app :title="'Edit Pembayaran'">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('payment.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                ← Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Pembayaran</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('payment.update', $payment) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="id_denda" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Denda</label>
                        <select name="id_denda" id="id_denda"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                        <label for="nominal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nominal Pembayaran</label>
                        <input type="number" name="nominal" id="nominal" value="{{ old('nominal', $payment->nominal) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required min="0">
                        @error('nominal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="proof_img" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Pembayaran</label>
                        <input type="file" name="proof_img" id="proof_img" accept="image/*"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload gambar bukti pembayaran baru (JPEG, PNG, JPG, GIF, max 2MB). Kosongkan jika tidak ingin mengubah.</p>
                        @if($payment->proof_img)
                            <p class="mt-1 text-sm text-green-600">Bukti saat ini: <a href="{{ Storage::url($payment->proof_img) }}" target="_blank" class="underline">Lihat</a></p>
                        @endif
                        @error('proof_img')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                        <a href="{{ route('payment.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
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