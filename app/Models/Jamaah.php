<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

    protected $table = 'jamaah';

    protected $fillable = [
        'registration_id',
        'title',
        'full_name',
        'nik',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'father_name',
        'occupation',
        'blood_type',
        'address',
        'province',
        'city',
        'emergency_name',
        'emergency_relation',
        'emergency_phone',
        'passport_number',
        'passport_issued_at',
        'passport_expired_at',
        'document_status',
        'completion_status',
        'profile_completed_at',
        'documents_completed_at'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'passport_issued_at' => 'date',
        'passport_expired_at' => 'date',
        'profile_completed_at' => 'datetime',
        'documents_completed_at' => 'datetime'
    ];

    // ========== RELATIONSHIPS ==========
    
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // ========== HELPER METHODS ==========
    
    /**
     * Get age dari birth_date
     */
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    /**
     * Check apakah data profil sudah lengkap
     */
    public function hasCompleteProfile(): bool
    {
        $requiredFields = [
            'title',
            'full_name',
            'nik',
            'birth_place',
            'birth_date',
            'gender',
            'marital_status',
            'father_name',
            'occupation',
            'address',
            'emergency_name',
            'emergency_relation',
            'emergency_phone'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field) || $this->$field === 'PENDING' || $this->$field === '-') {
                return false;
            }
        }

        return true;
    }

    /**
     * Check apakah dokumen sudah lengkap
     */
    public function hasCompleteDocuments(): bool
    {
        $requiredDocs = ['ktp', 'kk', 'photo'];
        
        if ($this->marital_status === 'married') {
            $requiredDocs[] = 'buku_nikah';
        }

        foreach ($requiredDocs as $type) {
            if (!$this->documents()->where('document_type', $type)->exists()) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Get missing documents
     */
    public function getMissingDocuments(): array
    {
        $requiredDocs = ['ktp', 'kk', 'photo'];
        
        if ($this->marital_status === 'married') {
            $requiredDocs[] = 'buku_nikah';
        }

        $existingDocs = $this->documents()->pluck('document_type')->toArray();
        
        return array_diff($requiredDocs, $existingDocs);
    }

    /**
     * Update completion status
     */
    public function updateCompletionStatus(): void
    {
        $hasProfile = $this->hasCompleteProfile();
        $hasDocs = $this->hasCompleteDocuments();

        if ($hasProfile && $hasDocs) {
            $this->update([
                'completion_status' => 'complete',
                'profile_completed_at' => $this->profile_completed_at ?? now(),
                'documents_completed_at' => now()
            ]);
        } elseif ($hasProfile) {
            $this->update([
                'completion_status' => 'partial',
                'profile_completed_at' => now()
            ]);
        } else {
            $this->update([
                'completion_status' => 'empty'
            ]);
        }

        // Update parent registration completion
        $this->registration->updateCompletion();
    }

    /**
     * Get completion percentage per jamaah
     */
    public function getCompletionPercentage(): int
    {
        $completion = 0;

        // Profile data (70%)
        if ($this->hasCompleteProfile()) {
            $completion += 70;
        }

        // Documents (30%)
        $requiredDocs = ['ktp', 'kk', 'photo'];
        if ($this->marital_status === 'married') {
            $requiredDocs[] = 'buku_nikah';
        }

        $uploadedDocs = $this->documents()->whereIn('document_type', $requiredDocs)->count();
        $totalRequired = count($requiredDocs);

        if ($totalRequired > 0) {
            $completion += (int) (($uploadedDocs / $totalRequired) * 30);
        }

        return min($completion, 100);
    }

    /**
     * Check if this is placeholder jamaah
     */
    public function isPlaceholder(): bool
    {
        return $this->nik === 'PENDING' 
            || $this->full_name === 'PENDING'
            || str_contains($this->full_name, 'Belum Dilengkapi');
    }

    /**
     * Get display name
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->isPlaceholder()) {
            return 'Jamaah ' . ($this->id % 100) . ' (Belum Dilengkapi)';
        }
        
        return $this->title . ' ' . $this->full_name;
    }
}