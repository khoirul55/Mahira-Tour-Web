<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'image_caption',
        'category_id',
        'tags',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'published_at',
        'author_id',
        'views_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // ── Relationships ──

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    // ── Scopes ──

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ── Accessors ──

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->body));
        return max(1, (int) ceil($wordCount / 200));
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->translatedFormat('d F Y')
            : $this->created_at->translatedFormat('d F Y');
    }

    // ── Boot ──

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            // Ensure slug uniqueness
            $originalSlug = $article->slug;
            $counter = 1;
            while (static::where('slug', $article->slug)->exists()) {
                $article->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('slug') && !empty($article->slug)) {
                $originalSlug = Str::slug($article->slug);
                $article->slug = $originalSlug;

                $counter = 1;
                while (static::where('slug', $article->slug)->where('id', '!=', $article->id)->exists()) {
                    $article->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }
}
