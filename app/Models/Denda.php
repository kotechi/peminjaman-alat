<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'denda';

    protected $fillable = [
        'id_pengembalian',
        'id_user',
        'nama_kategori',
        'status',
        'total_denda',
    ];

    protected $casts = [
        'status' => 'string',
        'total_denda' => 'integer',
    ];

    /**
     * Get the pengembalian that owns the denda.
     */
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'id_pengembalian');
    }

    /**
     * Get the user that owns the denda.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the payment for the denda.
     */
    public function payment()
    {
        return $this->hasMany(Payment::class, 'id_denda');
    }
}