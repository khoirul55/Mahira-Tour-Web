<?php

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
        'dp_amount',
        'payment_deadline',
        'document_deadline',
        'completion_percentage',
        'last_activity_at',
        'assigned_to',
        'status'
    ];

    protected $casts = [
        'payment_deadline' => 'date',
        'document_deadline' => 'date',
        'last_activity_at' => 'datetime',
        'total_price' => 'decimal:2',
        'dp_amount' => 'decimal:2'
    ];

    // ========== RELATIONSHIPS ==========
    
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

    // ========== STATIC METHODS ==========
    
    public static function generateRegistrationNumber(): string
    {
        return 'MHR-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    // ========== HELPER METHODS ==========
    
    /**
     * Generate secure access token untuk dashboard
     */
    public function generateAccessToken(): string
    {
        return hash_hmac(
            'sha256', 
            $this->registration_number . $this->email . $this->created_at->timestamp, 
            config('app.key')
        );
    }

    /**
     * Validate access token
     */
    public function validateAccessToken(string $token): bool
    {
        return hash_equals($this->generateAccessToken(), $token);
    }

    /**
     * Get dashboard URL dengan token
     */
    public function getDashboardUrlAttribute(): string
    {
        return route('registration.dashboard', [
            'reg' => $this->registration_number,
            'token' => $this->generateAccessToken()
        ]);
    }

    /**
     * Check apakah DP sudah verified
     */
    public function hasDPVerified(): bool
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->where('status', 'verified')
            ->exists();
    }

    /**
     * Check apakah DP sudah di-upload (belum verified)
     */
    public function hasDPUploaded(): bool
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->whereNotNull('proof_path')
            ->exists();
    }

    /**
     * Get DP payment record
     */
    public function dpPayment()
    {
        return $this->payments()->where('payment_type', 'dp')->first();
    }

    /**
     * Calculate completion percentage
     */
    public function calculateCompletion(): int
    {
        $completion = 0;

        // Step 1: Registration created (5%)
        $completion += 5;

        // Step 2: Semua data jamaah lengkap (35%)
        $totalJamaah = $this->num_people;
        $completeJamaah = $this->jamaah()
            ->where('completion_status', 'complete')
            ->count();
        
        if ($totalJamaah > 0) {
            $completion += (int) (($completeJamaah / $totalJamaah) * 35);
        }

        // Step 3: DP uploaded (20%)
        if ($this->hasDPUploaded()) {
            $completion += 20;
        }

        // Step 4: DP verified (20%)
        if ($this->hasDPVerified()) {
            $completion += 20;
        }

        // Step 5: Semua dokumen jamaah lengkap (20%)
        $jamaahWithCompleteDocs = $this->jamaah()
            ->whereHas('documents', function($q) {
                $q->whereIn('document_type', ['ktp', 'kk', 'photo']);
            })
            ->count();
        
        if ($totalJamaah > 0) {
            $completion += (int) (($jamaahWithCompleteDocs / $totalJamaah) * 20);
        }

        return min($completion, 100);
    }

    /**
     * Update completion percentage
     */
    public function updateCompletion(): void
    {
        $this->update([
            'completion_percentage' => $this->calculateCompletion(),
            'last_activity_at' => now()
        ]);
    }

    /**
     * Check apakah registrasi complete
     */
    public function isComplete(): bool
    {
        return $this->completion_percentage >= 100;
    }

    /**
     * Check apakah registrasi abandoned (> 48 jam tidak ada aktivitas)
     */
    public function isAbandoned(): bool
    {
        if (!$this->last_activity_at) {
            return $this->created_at->diffInHours(now()) > 48;
        }
        
        return $this->last_activity_at->diffInHours(now()) > 48;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'draft' => 'warning',
            'pending' => 'info',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Perlu Dilengkapi',
            'pending' => 'Menunggu Verifikasi',
            'confirmed' => 'Terkonfirmasi',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown'
        };
    }
}