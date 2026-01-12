<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number', 'access_token', 'schedule_id', 'full_name', 'email', 'phone',
        'num_people', 'notes', 'total_price', 'dp_amount', 'payment_deadline',
        'document_deadline', 'status', 'completion_percentage', 'last_activity_at',
        'pelunasan_amount', 'pelunasan_deadline', 'is_lunas'
    ];
    
    protected $casts = [
        'payment_deadline' => 'date',
        'document_deadline' => 'date',
        'pelunasan_deadline' => 'date',
        'last_activity_at' => 'datetime',
        'is_lunas' => 'boolean'
    ];
    
    // ================================
    // GENERATE METHODS
    // ================================
    
    public static function generateRegistrationNumber()
    {
        return 'MHR-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));
    }
    
    public function generateAccessToken()
    {
        if ($this->access_token) {
            return $this->access_token;
        }
        
        $token = hash('sha256', $this->registration_number . uniqid() . config('app.key') . time());
        $this->update(['access_token' => $token]);
        
        return $token;
    }
    
    public function validateAccessToken($token)
    {
        if (!$token || !$this->access_token) {
            return false;
        }
        
        return hash_equals($this->access_token, $token);
    }
    
    // ================================
    // COMPLETION METHODS
    // ================================
    
    public function calculateCompletion()
    {
        $percentage = 5; // Base: booking created
        
        // +30%: All jamaah data complete
        $totalJamaah = $this->num_people;
        $completeJamaah = $this->jamaah()->where('completion_status', 'complete')->count();
        $percentage += ($completeJamaah / $totalJamaah) * 30;
        
        // +30%: DP verified
        if ($this->hasDPVerified()) {
            $percentage += 30;
        }
        
        // +35%: All documents uploaded & verified
        $totalDocs = $totalJamaah * 3; // KTP, KK, Photo per jamaah
        $uploadedDocs = Document::whereIn('jamaah_id', $this->jamaah->pluck('id'))->count();
        $percentage += ($uploadedDocs / $totalDocs) * 35;
        
        return min(100, round($percentage));
    }
    
    public function updateCompletion()
    {
        $this->completion_percentage = $this->calculateCompletion();
        $this->save();
    }
    
    // ================================
    // PAYMENT METHODS
    // ================================
    
    public function hasDPVerified()
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->where('status', 'verified')
            ->exists();
    }
    
    public function dpPayment()
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->first();
    }
    
    // ✅ PELUNASAN METHODS (BARU)
    
    public function needsPelunasan()
    {
        return $this->status === 'confirmed' 
            && !$this->is_lunas 
            && $this->hasDPVerified();
    }
    
    public function sisaPelunasan()
    {
        $totalPaid = $this->payments()
            ->where('status', 'verified')
            ->sum('amount');
            
        return $this->total_price - $totalPaid;
    }
    
    public function pelunasanPayment()
    {
        return $this->payments()
            ->where('payment_type', 'pelunasan')
            ->first();
    }
    
    public function calculatePelunasanDeadline()
    {
        if ($this->schedule && $this->schedule->departure_date) {
            return $this->schedule->departure_date->copy()->subDays(30);
        }
        return null;
    }
    
    // ================================
    // DOCUMENT METHODS
    // ================================
    
    public function allDocsVerified()
    {
        foreach ($this->jamaah as $jamaah) {
            if (!$jamaah->allDocsVerified()) {
                return false;
            }
        }
        return true;
    }
    
    public function getTotalDocumentsCount()
    {
        return Document::whereIn('jamaah_id', $this->jamaah->pluck('id'))->count();
    }
    
    public function getRequiredDocumentsCount()
    {
        return $this->num_people * 3; // KTP, KK, Photo
    }
    
    public function hasPassportRequests()
    {
        return $this->jamaah()->where('need_passport', true)->exists();
    }
    
    public function passportRequests()
    {
        return $this->jamaah()->where('need_passport', true)->get();
    }
    
    // ================================
    // RELATIONSHIPS
    // ================================
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    
    public function jamaah()
    {
        return $this->hasMany(Jamaah::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}