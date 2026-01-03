<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'schedule_id',
        'pic_title',
        'pic_full_name',
        'pic_email',
        'pic_phone',
        'pic_address',
        'pic_province',
        'pic_city',
        'num_people',
        'departure_date',
        'departure_route',
        'notes',
        'total_price',
        'dp_amount',
        'dp_status',
        'dp_paid_at',
        'dp_verified_at',
        'dp_verified_by',
        'status'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'dp_paid_at' => 'datetime',
        'dp_verified_at' => 'datetime',
        'total_price' => 'decimal:2',
        'dp_amount' => 'decimal:2'
    ];

    // Relationships
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function jamaah()
    {
        return $this->hasMany(Jamaah::class);
    }

    // Helpers
    public static function generateRegistrationNumber()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        return "MHR-{$date}-{$random}";
    }

    public function calculateDP()
    {
        return $this->total_price * 0.30; // 30% DP
    }

    public function getRemainingPaymentAttribute()
    {
        return $this->total_price - $this->dp_amount;
    }
}