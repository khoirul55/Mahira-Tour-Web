<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'payment_type',
        'amount',
        'payment_method',
        'proof_path',
        'status',
        'verified_by',
        'verified_at',
        'rejection_reason'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function verifier()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }
}