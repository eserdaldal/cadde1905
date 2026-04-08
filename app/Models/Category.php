<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use \App\Models\Concerns\HasTags;
    protected $fillable = [
        'name',
        'slug',
        'type',
        'parent_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Model Events - Auto Slug
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = self::generateUniqueSlug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = self::generateUniqueSlug($category->name);
            }
        });
    }

    protected static function generateUniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id');
    }

    // Unified via HasTags

    /*
    |--------------------------------------------------------------------------
    | Type Configuration (Single Source of Truth)
    |--------------------------------------------------------------------------
    */

    public static function allowedTypes(): array
    {
        return [
            'news' => 'Haber',
            'legend' => 'Efsane',
            'history_event' => 'Tarihi Olay',
            'general' => 'Genel',
        ];
    }

    public function typeLabel(): string
    {
        return self::allowedTypes()[$this->type] ?? $this->type;
    }
}
