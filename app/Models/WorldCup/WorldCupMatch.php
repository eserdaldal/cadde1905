<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorldCupMatch extends Model
{
    protected $table = 'world_cup_matches';

    protected $fillable = [
        'tournament_id',
        'external_id',
        'stage',
        'round_name',
        'match_number',
        'home_team_id',
        'away_team_id',
        'stadium_id',
        'winner_team_id',
        'kickoff_at',
        'status',
        'home_score',
        'away_score',
        'home_penalty_score',
        'away_penalty_score',
        'referee',
        'attendance',
        'summary_api',
        'editor_note',
        'is_featured',
        'featured_lock',
        'is_visible',
        'slot_number',
        'venue_name_api',
        'venue_city_api',
        'venue_external_id_api',
        'is_locked',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'featured_lock' => 'boolean',
        'is_visible' => 'boolean',
        'is_locked' => 'boolean',
        'kickoff_at' => 'datetime',
    ];

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function stadium(): BelongsTo
    {
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }

    public function winnerTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }

    public function matchStadiumMap(): BelongsTo
    {
        return $this->belongsTo(MatchStadiumMap::class, 'slot_number', 'slot_number')
            ->where('tournament_id', 4);
    }
}
