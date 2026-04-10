<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorldCup extends Model
{
    protected $table = 'world_cup_tournaments';

    protected $fillable = [
        'external_id',
        'name',
        'slug',
        'year',
        'host_country',
        'starts_at',
        'ends_at',
        'status',
        'is_active',
        'is_visible',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'seo_title',
        'seo_description',
        'og_image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('visible', function (Builder $query) {
            $query->where('is_visible', true);
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public static function activeTournament(): ?self
    {
        return static::query()
            ->active()
            ->orderByDesc('year')
            ->first();
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'tournament_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'tournament_id');
    }

    public function stadiums(): HasMany
    {
        return $this->hasMany(Stadium::class, 'tournament_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(WorldCupMatch::class, 'tournament_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'tournament_id');
    }

    public function groupStandings(): HasMany
    {
        return $this->hasMany(GroupStanding::class, 'tournament_id');
    }

    public function contentRelations(): HasMany
    {
        return $this->hasMany(ContentRelation::class, 'tournament_id');
    }

    public function syncLogs(): HasMany
    {
        return $this->hasMany(SyncLog::class, 'tournament_id');
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class, 'tournament_id');
    }
}