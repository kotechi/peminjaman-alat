<?php

namespace App\Observers;

use App\Models\Alat;
use App\Models\LogAktivitas;

class AlatObserver
{
    public function created(Alat $alat): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'alat',
                'deskripsi' => 'Menambahkan alat baru: ' . $alat->nama_alat,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function updated(Alat $alat): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'alat',
                'deskripsi' => 'Mengubah data alat: ' . $alat->nama_alat,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function deleted(Alat $alat): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'alat',
                'deskripsi' => 'Menghapus alat: ' . $alat->nama_alat,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }
}
