<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ContentRelation extends Model
{
    protected $table = 'world_cup_content_relations';

    protected $fillable = [
        'tournament_id',
        'related_type',
        'related_id',
        'relation_type',
        'is_featured',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function related(): MorphTo
    {
        return $this->morphTo();
    }
}
