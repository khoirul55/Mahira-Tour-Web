<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'jamaah_id',
        'document_type',
        'file_path',
        'file_name',
        'is_verified',
        'verified_by',
        'verified_at',
        'verification_notes'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime'
    ];

    // Relationships
    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class);
    }

    // Helpers
    public function getUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    public function delete()
    {
        // Delete file from storage
        if (Storage::exists($this->file_path)) {
            Storage::delete($this->file_path);
        }
        return parent::delete();
    }
}