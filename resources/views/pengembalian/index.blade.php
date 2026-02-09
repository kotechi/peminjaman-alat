<x-layouts::app :title="'Daftar Pengembalian'">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Pengembalian</h1>
            <a href="{{ route('pengembalian.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                Tambah Pengembalian
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Terlambat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($pengembalian as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ $item->peminjaman->user->name }}</div>
                                    <div class="text-gray-500 dark:text-gray-400">{{ $item->peminjaman->alat->nama_alat }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->tanggal_kembali_realisasi->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->hari_terlambat }} hari
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($item->status == 'menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($item->status == 'disetujui') bg-green-100 text-green-800
                                        @elseif($item->status == 'ditolak') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('pengembalian.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                    @if($item->status == 'menunggu')
                                        <form method="POST" action="{{ route('pengembalian.confirm', $item) }}" class="inline mr-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 text-sm">Setujui</button>
                                        </form>
                                        <form method="POST" action="{{ route('pengembalian.confirm', $item) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm">Tolak</button>
                                        </form>
                                    @elseif($item->status == 'disetujui')
                                        <form method="POST" action="{{ route('pengembalian.confirm', $item) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm">Selesai</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data pengembalian
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                {{ $pengembalian->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>