<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $table = 'world_cup_groups';

    protected $fillable = [
        'tournament_id',
        'external_id',
        'code',
        'name',
        'stage',
        'sort_order',
        'title_override',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('visible', function (Builder $query) {
            $query->where('is_visible', true);
        });
    }

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'group_id');
    }

    public function groupStandings(): HasMany
    {
        return $this->hasMany(GroupStanding::class, 'group_id');
    }
}
