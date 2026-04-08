<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    protected $fillable = [
        'key',
        'title',
        'subtitle',
        'description',
        'cta_label',
        'cta_route_name',
        'cta_route_params',
        'status',
        'is_enabled',
        'priority',
        'starts_at',
        'ends_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'cta_route_params' => 'array',
        'is_enabled' => 'boolean',
        'priority' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
