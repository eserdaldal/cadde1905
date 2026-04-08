<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $table = 'world_cup_teams';

    protected $fillable = [
        'tournament_id',
        'group_id',
        'external_id',
        'name_api',
        'short_name_api',
        'name_override',
        'short_name_override',
        'slug',
        'fifa_code',
        'confederation',
        'coach_name_api',
        'flag_image_api',
        'image_override',
        'description_editorial',
        'is_featured',
        'featured_lock',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'featured_lock' => 'boolean',
        'is_visible' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('visible', function (Builder $query) {
            $query->where('is_visible', true);
        });
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)
                     ->where('is_visible', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(WorldCupMatch::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(WorldCupMatch::class, 'away_team_id');
    }

    public function wonMatches(): HasMany
    {
        return $this->hasMany(WorldCupMatch::class, 'winner_team_id');
    }

    public function groupStandings(): HasMany
    {
        return $this->hasMany(GroupStanding::class, 'team_id');
    }

    public function getFlagUrlAttribute(): ?string
    {
        return $this->flag_image_api ?: null;
    }
}
