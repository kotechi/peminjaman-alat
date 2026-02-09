<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'deskripsi',
        'id_user',
        'jenis_aktivitas',
        'tanggal_aktivitas',
    ];

    protected $casts = [
        'tanggal_aktivitas' => 'date',
    ];

    /**
     * Get the user that owns the log activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
