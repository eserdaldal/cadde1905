<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WidgetOverride extends Model
{
    protected $table = 'widget_overrides';

    protected $fillable = [
        'widget_key',
        'is_enabled',
        'priority_override',
        'notes',
        'updated_by',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'priority_override' => 'integer',
    ];

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
