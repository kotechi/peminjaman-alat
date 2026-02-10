<?php

namespace App\Observers;

use App\Models\Peminjaman;
use App\Models\LogAktivitas;

class PeminjamanObserver
{
    public function created(Peminjaman $peminjaman): void
    {
        LogAktivitas::create([
            'id_user' => auth()->id() ?? $peminjaman->id_user,
            'jenis_aktivitas' => 'peminjaman',
            'deskripsi' => 'Mengajukan peminjaman alat: ' . $peminjaman->alat?->nama_alat ?? 'ID: ' . $peminjaman->id_alat,
            'tanggal_aktivitas' => now(),
        ]);
    }

    public function updated(Peminjaman $peminjaman): void
    {
        $changes = $peminjaman->getChanges();
        
        if (isset($changes['status'])) {
            $statusLama = $peminjaman->getOriginal('status');
            $statusBaru = $changes['status'];
            
            $deskripsi = "Status peminjaman diubah dari '{$statusLama}' menjadi '{$statusBaru}'";
            
            if ($statusBaru === 'approved') {
                $deskripsi = 'Menyetujui peminjaman alat: ' . $peminjaman->alat?->nama_alat ?? 'ID: ' . $peminjaman->id_alat;
            } elseif ($statusBaru === 'rejected') {
                $deskripsi = 'Menolak peminjaman alat: ' . $peminjaman->alat?->nama_alat ?? 'ID: ' . $peminjaman->id_alat;
            }
            
            LogAktivitas::create([
                'id_user' => auth()->id() ?? $peminjaman->id_user,
                'jenis_aktivitas' => 'peminjaman',
                'deskripsi' => $deskripsi,
                'tanggal_aktivitas' => now(),
            ]);
        } else {
            LogAktivitas::create([
                'id_user' => auth()->id() ?? $peminjaman->id_user,
                'jenis_aktivitas' => 'peminjaman',
                'deskripsi' => 'Mengubah data peminjaman ID: ' . $peminjaman->id,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function deleted(Peminjaman $peminjaman): void
    {
        LogAktivitas::create([
            'id_user' => auth()->id() ?? $peminjaman->id_user,
            'jenis_aktivitas' => 'peminjaman',
            'deskripsi' => 'Menghapus peminjaman alat: ' . $peminjaman->alat?->nama_alat ?? 'ID: ' . $peminjaman->id_alat,
            'tanggal_aktivitas' => now(),
        ]);
    }
}
