<?php

namespace App\Models;

use App\Models\Concerns\HasCoverMedia;
use App\Models\Concerns\HasDemoLock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class HistoricalMatch extends Model
{
    use HasCoverMedia, HasDemoLock, \App\Models\Concerns\HasTags;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'match_date',
        'opponent',
        'competition',
        'score_for',
        'score_against',
        'result',
        'importance_score',
        'is_featured',
        'is_published',
        'published_at',
        'is_demo', // ✅ EKLENDİ
    ];

    protected $casts = [
        'match_date' => 'date',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'importance_score' => 'integer',
        'score_for' => 'integer',
        'score_against' => 'integer',
        'is_demo' => 'boolean', // ✅ EKLENDİ
    ];

    protected function legacyCoverColumn(): ?string
    {
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
