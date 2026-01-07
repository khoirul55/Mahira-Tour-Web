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
        'document_status'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'passport_issued_at' => 'date',
        'passport_expired_at' => 'date'
    ];

    // Relationships
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Helpers
    public function getAgeAttribute()
    {
        return $this->birth_date->age;
    }

    public function hasCompleteDocuments()
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
}