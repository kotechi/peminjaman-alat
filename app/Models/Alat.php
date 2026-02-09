<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    protected $fillable = [
        'id_kategori',
        'nama_alat',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the kategori that owns the alat.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    /**
     * Get the peminjaman for the alat.
     */
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_alat');
    }
}