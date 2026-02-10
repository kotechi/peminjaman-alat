<?php

namespace App\Observers;

use App\Models\Kategori;
use App\Models\LogAktivitas;

class KategoriObserver
{
    public function created(Kategori $kategori): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'kategori',
                'deskripsi' => 'Menambahkan kategori baru: ' . $kategori->nama_kategori,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function updated(Kategori $kategori): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'kategori',
                'deskripsi' => 'Mengubah kategori: ' . $kategori->nama_kategori,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }

    public function deleted(Kategori $kategori): void
    {
        if (auth()->check()) {
            LogAktivitas::create([
                'id_user' => auth()->id(),
                'jenis_aktivitas' => 'kategori',
                'deskripsi' => 'Menghapus kategori: ' . $kategori->nama_kategori,
                'tanggal_aktivitas' => now(),
            ]);
        }
    }
}
