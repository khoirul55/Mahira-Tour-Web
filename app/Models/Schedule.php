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
        'price_triple',
        'price_double',
        'price_child',
        'quota',
        'seats_taken',
        'flyer_image',
        'status',
        'description',
        'hotel_makkah',
        'hotel_makkah_image',
        'hotel_madinah',
        'hotel_madinah_image',
        'itinerary',
        'itinerary_pdf',
        'features',
        'excludes',
        'gifts',
        'additional_info'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'price' => 'decimal:2',
        'itinerary' => 'array', // Casting to array for easier JSON handling
        'features' => 'array'   // Casting to array
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