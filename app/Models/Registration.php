<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number', 'schedule_id', 'full_name', 'email', 'phone',
        'num_people', 'notes', 'total_price', 'dp_amount', 'payment_deadline',
        'document_deadline', 'status', 'completion_percentage', 'last_activity_at'
    ];
    
    protected $casts = [
        'payment_deadline' => 'date',
        'document_deadline' => 'date',
        'last_activity_at' => 'datetime'
    ];
    
    // ✅ Generate Registration Number
    public static function generateRegistrationNumber()
    {
        return 'MHR-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));
    }
    
    // ✅ Generate Access Token
    public function generateAccessToken()
    {
        return hash('sha256', $this->registration_number . $this->email . config('app.key'));
    }
    
    // ✅ Validate Access Token
    public function validateAccessToken($token)
    {
        return $token === $this->generateAccessToken();
    }
    
    // ✅ Calculate Completion Percentage
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
    
    // ✅ Update Completion
    public function updateCompletion()
    {
        $this->completion_percentage = $this->calculateCompletion();
        $this->save();
    }
    
    // ✅ Check if DP Verified
    public function hasDPVerified()
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->where('status', 'verified')
            ->exists();
    }
    
    // ✅ Get DP Payment
    public function dpPayment()
    {
        return $this->payments()
            ->where('payment_type', 'dp')
            ->first();
    }
    
    // Relations
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