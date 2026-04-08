<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StadiumAlias extends Model
{
    protected $table = 'world_cup_stadium_aliases';

    protected $fillable = [
        'stadium_id',
        'alias_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function stadium(): BelongsTo
    {
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }
}
