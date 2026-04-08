<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupStanding extends Model
{
    protected $table = 'world_cup_group_standings';

    protected $fillable = [
        'tournament_id',
        'group_id',
        'team_id',
        'played',
        'won',
        'drawn',
        'lost',
        'goals_for',
        'goals_against',
        'goal_difference',
        'points',
        'position',
        'qualified_status',
        'visibility_override',
        'snapshot_at',
    ];

    protected $casts = [
        'visibility_override' => 'boolean',
        'snapshot_at' => 'datetime',
    ];

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
