<?php

namespace App\Models;

use App\Services\Timeline\TimelineUrlResolver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use App\Models\Concerns\HasDemoLock;

class TimelineEntry extends Model
{
    use HasDemoLock, \App\Models\Concerns\HasTags;

    protected $fillable = [
        'timeline_date',
        'title',
        'excerpt',
        'type',
        'icon',
        'source_type',
        'source_id',
        'is_visible',
        'position',
        'is_demo',
    ];

    protected $casts = [
        'timeline_date' => 'date',
        'is_visible' => 'boolean',
        'position' => 'integer',
        'is_demo' => 'boolean',
    ];

    public const TYPES = [
        'moment' => 'An',
        'match' => 'Maç',
        'season' => 'Sezon',
        'legend' => 'Efsane',
        'trophy' => 'Kupa',
        'milestone' => 'Dönüm Noktası',
        'achievement' => 'Başarı',
        'era' => 'Dönem',
        'squad' => 'Kadro',
    ];

    public const ICONS = [
        'star' => 'Yıldız',
        'trophy' => 'Kupa',
        'calendar' => 'Takvim',
        'flag' => 'Bayrak',
        'users' => 'Kadro',
        'shirt' => 'Forma',
        'history' => 'Tarih',
    ];

    public static function typeOptions(): array
    {
        return self::TYPES;
    }

    public static function iconOptions(): array
    {
        return self::ICONS;
    }

    public static function sourceTypeOptions(): array
    {
        return [
            \App\Models\HistoryEvent::class => 'HistoryEvent',
            \App\Models\HistoricalMatch::class => 'HistoricalMatch',
            \App\Models\SeasonArchive::class => 'SeasonArchive',
            \App\Models\Legend::class => 'Legend',
            \App\Models\Trophy::class => 'Trophy',
        ];
    }

    public function source(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrderedForPublic(Builder $query): Builder
    {
        return $query
            ->orderBy('timeline_date', 'asc')
            ->orderBy('position', 'asc')
            ->orderBy('id', 'asc');
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getSourceLabelAttribute(): ?string
    {
        if (! $this->source_type) {
            return null;
        }

        return class_basename($this->source_type);
    }

    // 🔥 YENİ HELPERS

    public function isReferenced(): bool
    {
        return ! empty($this->source_type) && ! empty($this->source_id);
    }

    public function isStandalone(): bool
    {
        return empty($this->source_type) && empty($this->source_id);
    }

    public function hasValidSourcePair(): bool
    {
        return $this->isReferenced() || $this->isStandalone();
    }

    public function hasSource(): bool
    {
        return $this->isReferenced();
    }

    public function detailUrl(): ?string
    {
        if (! $this->relationLoaded('source')) {
            $this->load('source');
        }

        if (! $this->source) {
            return null;
        }

        return app(TimelineUrlResolver::class)->resolve($this->source);
    }

    public function hasDetailUrl(): bool
    {
        return ! empty($this->detailUrl());
    }
}