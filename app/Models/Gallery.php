<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'category',
        'image_path',
        'display_order',
        'is_active',
        'show_on_home'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_home' => 'boolean',
    ];

    // Helper: Get image URL
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    // Helper: Delete with file
    public function deleteWithFile()
    {
        if (Storage::disk('public')->exists($this->image_path)) {
            Storage::disk('public')->delete($this->image_path);
        }
        return $this->delete();
    }

    // Scope: Active only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: By category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope: Show on Home
    public function scopeShowOnHome($query)
    {
        return $query->where('show_on_home', true);
    }

    // Scope: Ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')
                     ->orderBy('created_at', 'desc');
    }
}