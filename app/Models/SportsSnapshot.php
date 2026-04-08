<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class SportsSnapshot extends Model
{
    protected $table = 'sports_snapshots';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'team_id' => 'integer',
            'scope_id' => 'integer',
            'season' => 'integer',
            'result_limit' => 'integer',
            'last_success_at' => 'immutable_datetime',
            'expires_at' => 'immutable_datetime',
        ];
    }

    public function scopeForScope(
        Builder $query,
        string $snapshotKey,
        string $scopeType,
        int $scopeId,
        int $season,
        int $resultLimit = 0
    ): Builder {
        return $query
            ->where('snapshot_key', $snapshotKey)
            ->where('scope_type', $scopeType)
            ->where('scope_id', $scopeId)
            ->where('season', $season)
            ->where('result_limit', $resultLimit);
    }

    public function scopeForTeam(
        Builder $query,
        string $snapshotKey,
        int $teamId,
        int $season
    ): Builder {
        return $query->forScope($snapshotKey, 'team', $teamId, $season, 0);
    }

    public function scopeForLeague(
        Builder $query,
        string $snapshotKey,
        int $leagueId,
        int $season,
        int $resultLimit = 0
    ): Builder {
        return $query->forScope($snapshotKey, 'league', $leagueId, $season, $resultLimit);
    }
}