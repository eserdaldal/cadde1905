<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    protected $table = 'world_cup_settings';

    protected $fillable = [
        'tournament_id',
        'wc_module_enabled',
        'home_teaser_enabled',
        'countdown_enabled',
        'show_featured_players',
        'show_featured_matches',
        'show_featured_stadiums',
        'show_stat_cards',
        'stale_data_notice_enabled',
    ];

    protected $casts = [
        'wc_module_enabled' => 'boolean',
        'home_teaser_enabled' => 'boolean',
        'countdown_enabled' => 'boolean',
        'show_featured_players' => 'boolean',
        'show_featured_matches' => 'boolean',
        'show_featured_stadiums' => 'boolean',
        'show_stat_cards' => 'boolean',
        'stale_data_notice_enabled' => 'boolean',
    ];

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }
}
