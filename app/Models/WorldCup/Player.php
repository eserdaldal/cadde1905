<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    protected $table = 'world_cup_players';

    protected $fillable = [
        'tournament_id',
        'team_id',
        'external_id',
        'name_api',
        'name_override',
        'slug',
        'shirt_number',
        'position',
        'date_of_birth',
        'nationality',
        'club_name_api',
        'club_name_normalized',
        'image_api',
        'image_override',
        'bio_editorial',
        'is_featured',
        'is_visible',
        'is_galatasaray_related',
        'galatasaray_relation_type',
        'galatasaray_note',
        'gs_relation_lock',
        'gs_relation_approved_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'is_galatasaray_related' => 'boolean',
        'gs_relation_lock' => 'boolean',
        'date_of_birth' => 'date',
        'gs_relation_approved_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
