<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'departure_date',
        'return_date',
        'departure_route',
        'airline',
        'duration',
        'price',
        'quota',
        'seats_taken',
        'flyer_image',
        'status'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'price' => 'decimal:2'
    ];

    // Relationships
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Helpers
    public function getAvailableSeatsAttribute()
    {
        return $this->quota - $this->seats_taken;
    }

    public function isAvailable()
    {
        return $this->status === 'active' && $this->available_seats > 0;
    }

    public function updateStatus()
    {
        if ($this->seats_taken >= $this->quota) {
            $this->update(['status' => 'full']);
        }
    }
}