<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncLog extends Model
{
    protected $table = 'world_cup_sync_logs';

    protected $fillable = [
        'tournament_id',
        'dataset',
        'source',
        'started_at',
        'finished_at',
        'records_processed',
        'records_skipped',
        'warnings_count',
        'errors_count',
        'status',
        'error_summary',
        'batch_uuid',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }
}
