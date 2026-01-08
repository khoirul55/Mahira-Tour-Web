<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    
    protected $fillable = [
        'registration_id', 'title', 'full_name', 'nik', 'birth_place', 'birth_date',
        'gender', 'marital_status', 'father_name', 'occupation', 'blood_type',
        'address', 'province', 'city', 'emergency_name', 'emergency_relation',
        'emergency_phone', 'completion_status'
    ];
    
    protected $casts = [
        'birth_date' => 'date'
    ];
    
    // ✅ Cek apakah data placeholder
    public function isPlaceholder()
    {
        return $this->nik === 'PENDING' || 
               $this->full_name === 'Jamaah ' . $this->id . ' - Belum Dilengkapi';
    }
    
    // ✅ Display name
    public function getDisplayNameAttribute()
    {
        return $this->title . ' ' . $this->full_name;
    }
    
    // ✅ Update completion status (PENTING!)
    public function updateCompletionStatus()
    {
        // Field wajib yang harus diisi
        $requiredFields = [
            'title', 'full_name', 'nik', 'birth_place', 'birth_date',
            'gender', 'marital_status', 'father_name', 'occupation',
            'address', 'emergency_name', 'emergency_relation', 'emergency_phone'
        ];
        
        $filledCount = 0;
        $totalFields = count($requiredFields);
        
        foreach ($requiredFields as $field) {
            $value = $this->$field;
            
            // Cek apakah field terisi (tidak null, tidak '-', tidak 'PENDING')
            if ($value && $value !== '-' && $value !== 'PENDING') {
                $filledCount++;
            }
        }
        
        // Hitung persentase
        $percentage = ($filledCount / $totalFields) * 100;
        
        // Update status
        if ($percentage === 100) {
            $this->completion_status = 'complete';
            $this->profile_completed_at = now();
        } elseif ($percentage > 0) {
            $this->completion_status = 'partial';
        } else {
            $this->completion_status = 'empty';
        }
        
        $this->save();
        
        // Update registration completion percentage
        $this->registration->updateCompletion();
        
        return $this->completion_status;
    }
    
    // Relations
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
    
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}