<x-layouts::app :title="'Daftar Pembayaran'">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Pembayaran</h1>
            <a href="{{ route('payment.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                Tambah Pembayaran
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Denda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bukti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($payment as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ $item->denda->pengembalian->peminjaman->user->name }}</div>
                                    <div class="text-gray-500 dark:text-gray-400">{{ $item->denda->nama_kategori }}</div>
                                    <div class="text-xs text-gray-400 dark:text-gray-500">Rp {{ number_format($item->denda->total_denda) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    Rp {{ number_format($item->nominal) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    @if($item->proof_img)
                                        <a href="{{ Storage::url($item->proof_img) }}" target="_blank" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($item->status == 'menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($item->status == 'disetujui') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('payment.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                    @if($item->status == 'menunggu')
                                        <form method="POST" action="{{ route('payment.confirm', $item) }}" class="inline mr-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 text-sm">Setujui</button>
                                        </form>
                                        <form method="POST" action="{{ route('payment.confirm', $item) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm">Tolak</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('payment.destroy', $item) }}" class="inline ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data pembayaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                {{ $payment->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>