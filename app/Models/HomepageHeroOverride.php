<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HomepageHeroOverride extends Model
{
    protected $table = 'homepage_hero_overrides';

    protected $fillable = [
        'item_type',
        'item_id',
        'content_key',
        'starts_at',
        'ends_at',
        'is_active',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function isCurrentlyActive(): bool
    {
        $now = now();

        if (! $this->is_active) {
            return false;
        }

        if ($this->starts_at && $this->starts_at > $now) {
            return false;
        }

        if ($this->ends_at <= $now) {
            return false;
        }

        return true;
    }
}
