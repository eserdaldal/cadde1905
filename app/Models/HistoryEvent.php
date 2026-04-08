<?php

namespace App\Models;

use App\Models\Concerns\HasOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use App\Models\Concerns\HasDemoLock;

class HistoryEvent extends Model
{
    use HasOwner, HasDemoLock, \App\Models\Concerns\HasTags;

    protected $table = 'history_events';

    protected $fillable = [
        'month',
        'day',
        'year',
        'event_date',
        'start_date',
        'end_date',
        'title',
        'slug',
        'type',
        'description',
        'excerpt',
        'content',
        'source_url',
        'is_on_this_day',
        'on_this_day_month',
        'on_this_day_day',
        'is_published',
        'published_at',
        'importance_score',
        'is_featured',
        'is_canonical',
        'canonical_key',
        'created_by',
    ];

    protected $casts = [
        'month' => 'integer',
        'day' => 'integer',
        'year' => 'integer',
        'event_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_on_this_day' => 'boolean',
        'on_this_day_month' => 'integer',
        'on_this_day_day' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'importance_score' => 'integer',
        'is_featured' => 'boolean',
        'is_canonical' => 'boolean',
    ];

    public function legends(): BelongsToMany
    {
        return $this->belongsToMany(
            Legend::class,
            'history_event_legend',
            'history_event_id',
            'legend_id'
        )->withTimestamps();
    }

    public function trophies(): BelongsToMany
    {
        return $this->belongsToMany(
            Trophy::class,
            'history_event_trophy',
            'history_event_id',
            'trophy_id'
        )->withPivot([
            'is_primary',
            'relation_type',
            'notes',
        ])->withTimestamps();
    }

    public function historicalMatches(): BelongsToMany
    {
        return $this->belongsToMany(
            HistoricalMatch::class,
            'historical_match_history_event',
            'history_event_id',
            'historical_match_id'
        )->withPivot([
            'is_primary',
            'relation_type',
            'notes',
            'sort_order',
        ])->withTimestamps();
    }

    public function seasonArchives(): BelongsToMany
    {
        return $this->belongsToMany(
            SeasonArchive::class,
            'history_event_season_archive',
            'history_event_id',
            'season_archive_id'
        )->withPivot([
            'is_primary',
            'relation_type',
            'notes',
            'sort_order',
        ])->withTimestamps();
    }

    public function media(): MorphToMany
    {
        return $this->morphToMany(
            Media::class,
            'mediable',
            'mediaables'
        )->withPivot([
            'usage_type',
            'sort_order',
            'is_primary',
            'title_override',
            'caption',
            'credit',
            'notes',
        ])->withTimestamps();
    }

    public function coverMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'cover');
    }

    public function galleryMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'gallery');
    }

    public function videoMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'video');
    }

    public function primaryCover()
    {
        return $this->media()
            ->wherePivot('usage_type', 'cover')
            ->wherePivot('is_primary', true)
            ->orderByDesc('mediaables.id');
    }

    // ✅ CONTENT MEDIA RELATION
    public function contentMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'content');
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