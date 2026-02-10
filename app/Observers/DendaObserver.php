<?php

namespace App\Observers;

use App\Models\Denda;
use App\Models\LogAktivitas;

class DendaObserver
{
    public function created(Denda $denda): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'denda',
                'deskripsi' => 'Menambahkan denda sebesar Rp ' . number_format($denda->total_denda, 0, ',', '.') . ' untuk user ID: ' . $denda->id_user,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function updated(Denda $denda): void
    {
        if (auth()->check()) {
            $changes = $denda->getChanges();
            
            if (isset($changes['status'])) {
                $deskripsi = "Status denda diubah menjadi '{$changes['status']}'";
            } else {
                $deskripsi = 'Mengubah data denda ID: ' . $denda->id;
            }
            
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'denda',
                'deskripsi' => $deskripsi,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function deleted(Denda $denda): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'denda',
                'deskripsi' => 'Menghapus denda ID: ' . $denda->id,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }
}
