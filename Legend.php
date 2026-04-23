<?php

namespace App\Models;

use App\Models\Concerns\HasCoverMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Concerns\HasDemoLock;

class Legend extends Model
{
    use SoftDeletes, HasDemoLock, HasCoverMedia, \App\Models\Concerns\HasTags;

    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'title',
        'summary',
        'content',
        'era_start_year',
        'era_end_year',
        'is_published',
        'published_at',
        'importance_score',
        'is_featured',
        'is_demo',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'importance_score' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'is_demo' => 'boolean',
    ];

    protected $appends = [
        'image_path',
    ];

    public function getImagePathAttribute(): ?string
    {
        return $this->coverImageUrl();
    }

    public function setImagePathAttribute($value): void
    {
        // Legacy image_path writes are ignored; canonical cover is handled elsewhere.
    }

    public function coverImageUrl(): ?string
    {
        $primaryMedia = $this->primaryCoverMedia();

        if ($primaryMedia && ! empty($primaryMedia->path)) {
            $disk = $primaryMedia->disk ?: 'public';

            try {
                return '/storage/' . ltrim($primaryMedia->path, '/');
            } catch (\Throwable $e) {
                // fallback below
            }
        }

        return null;
    }

    protected function legacyCoverColumn(): ?string
    {
        return null;
    }

    protected function coverMediaAltText(): ?string
    {
        return $this->name;
    }

    // ✅ CONTENT MEDIA

    // ✅ CONTENT MEDIA RELATION
    public function contentMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'content');
    }

    public function galleryMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'gallery');
    }

    public function videoMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'video');
    }

    // ✅ CONTENT MEDIA SYNC
    public function syncContentMedia(array $paths): void
    {
        $mediaIds = [];

        foreach ($paths as $path) {
            $media = \App\Models\Media::firstOrCreate([
                'disk' => 'public',
                'path' => $path,
            ]);

            $mediaIds[$media->id] = [
                'usage_type' => 'content',
                'is_primary' => 0,
                'sort_order' => 0,
            ];
        }

        $this->contentMedia()->sync($mediaIds);
    }
}
