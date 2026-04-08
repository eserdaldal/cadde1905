<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchStadiumMap extends Model
{
    protected $table = 'world_cup_match_stadium_map';

    protected $fillable = [
        'tournament_id',
        'slot_number',
        'stadium_id',
        'source',
        'is_locked',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function stadium(): BelongsTo
    {
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }
}
