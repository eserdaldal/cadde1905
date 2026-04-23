<?php

namespace App\Models;

use App\Models\Concerns\HasCoverMedia;
use App\Models\Concerns\HasDemoLock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SeasonArchive extends Model
{
    use HasCoverMedia, HasDemoLock, \App\Models\Concerns\HasTags;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'season_label',
        'start_year',
        'end_year',
        'season_overview',
        'league_summary',
        'europe_summary',
        'cup_summary',
        'manager_name',
        'importance_score',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'start_year' => 'integer',
        'end_year' => 'integer',
        'importance_score' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected function legacyCoverColumn(): ?string
    {
        return null;
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

    protected function coverMediaAltText(): ?string
    {
        return $this->title;
    }

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
