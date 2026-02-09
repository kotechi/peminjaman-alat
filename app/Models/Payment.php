<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'id_denda',
        'status',
        'nominal',
        'proof_img',
    ];

    protected $casts = [
        'status' => 'string',
        'nominal' => 'integer',
    ];

    /**
     * Get the denda that owns the payment.
     */
    public function denda()
    {
        return $this->belongsTo(Denda::class, 'id_denda');
    }
}