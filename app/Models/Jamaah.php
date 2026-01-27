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
        'completion_status',
        // Passport fields
        'need_passport',
        'passport_request_at',
        'passport_processed',
        'passport_processed_at',
        'passport_processed_by',
        'passport_notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'need_passport' => 'boolean',
        'passport_processed' => 'boolean',
        'passport_request_at' => 'datetime',
        'passport_processed_at' => 'datetime'
    ];

    // ================================
    // RELATIONSHIPS
    // ================================
    
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // ================================
    // ACCESSORS
    // ================================
    
    public function getDisplayNameAttribute()
    {
        if ($this->isPlaceholder()) {
            return 'Jamaah (Belum Dilengkapi)';
        }
        return $this->title . ' ' . $this->full_name;
    }

    // ================================
    // HELPERS
    // ================================
    
    /**
     * Check if jamaah is still a placeholder
     */
    public function isPlaceholder()
    {
        return $this->nik === 'PENDING' || 
               str_contains($this->full_name, 'Belum Dilengkapi');
    }

    /**
     * Update completion status based on filled fields
     */
    public function updateCompletionStatus()
    {
        $requiredFields = [
            'full_name', 'nik', 'birth_place', 'birth_date', 
            'gender', 'father_name', 'occupation', 'address',
            'emergency_name', 'emergency_relation', 'emergency_phone'
        ];

        $filledCount = 0;
        foreach ($requiredFields as $field) {
            if (!empty($this->$field) && 
                $this->$field !== '-' && 
                $this->$field !== 'PENDING' &&
                !str_contains($this->$field, 'Belum Dilengkapi')) {
                $filledCount++;
            }
        }

        // Check documents
        // Mandatory: KTP, KK
        // Select One: Ijazah OR Buku Nikah OR Akta
        $mandatoryDocs = ['ktp', 'kk'];
        $selectOneDocs = ['ijazah', 'buku_nikah', 'akta_kelahiran'];
        
        $uploadedTypes = $this->documents()->pluck('document_type')->toArray();
        
        $hasMandatory = count(array_intersect($mandatoryDocs, $uploadedTypes)) === count($mandatoryDocs);
        $hasSelectOne = count(array_intersect($selectOneDocs, $uploadedTypes)) > 0;

        if ($filledCount === count($requiredFields) && $hasMandatory && $hasSelectOne) {
            $this->completion_status = 'complete';
        } elseif ($filledCount > 0 || count($uploadedTypes) > 0) {
            $this->completion_status = 'partial';
        } else {
            $this->completion_status = 'empty';
        }

        $this->save();

        // Update registration completion
        $this->registration->updateCompletion();
    }

    /**
     * Get document by type
     */
    public function getDocument($type)
    {
        return $this->documents()->where('document_type', $type)->first();
    }

    /**
     * Check if all required documents are uploaded
     */
    public function hasAllRequiredDocuments()
    {
        $mandatoryDocs = ['ktp', 'kk'];
        $selectOneDocs = ['ijazah', 'buku_nikah', 'akta_kelahiran'];
        
        $uploadedTypes = $this->documents()->pluck('document_type')->toArray();
        
        $hasMandatory = count(array_intersect($mandatoryDocs, $uploadedTypes)) === count($mandatoryDocs);
        $hasSelectOne = count(array_intersect($selectOneDocs, $uploadedTypes)) > 0;
        
        return $hasMandatory && $hasSelectOne;
    }

    /**
     * Check if all documents are verified
     */
    public function allDocsVerified()
    {
        if ($this->documents->isEmpty()) {
            return false;
        }
        
        return $this->documents->every(fn($doc) => $doc->is_verified);
    }
}