<?php
// app/Models/Registration.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'schedule_id',
        'full_name',
        'email',
        'phone',
        'num_people',
        'notes',
        'total_price',
        'status'
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function jamaah(): HasMany
    {
        return $this->hasMany(Jamaah::class);
    }

    public static function generateRegistrationNumber(): string
    {
        return 'MHR-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    // Helper: Cek apakah DP sudah verified
    public function hasDPVerified(): bool
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->where('status', 'verified')
            ->exists();
    }
}

