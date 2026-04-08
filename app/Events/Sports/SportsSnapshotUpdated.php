<?php

declare(strict_types=1);

namespace App\Events\Sports;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class SportsSnapshotUpdated
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param string $snapshotKey next_match, standings, etc.
     * @param string $scopeType team or league
     * @param int $scopeId team_id or league_id
     */
    public function __construct(
        public readonly string $snapshotKey,
        public readonly string $scopeType,
        public readonly int $scopeId,
        public readonly int $season
    ) {
    }
}
