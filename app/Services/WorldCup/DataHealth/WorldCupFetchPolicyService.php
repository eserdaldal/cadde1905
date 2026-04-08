<?php

declare(strict_types=1);

namespace App\Services\WorldCup\DataHealth;

use App\Models\WorldCup\SyncLog;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Carbon;

final class WorldCupFetchPolicyService
{
    public function __construct(private readonly WorldCupDataHealthService $healthService)
    {
    }

    /**
     * Decisions on whether to allow a new API fetch for a dataset.
     */
    public function shouldFetch(string $dataset, int $tournamentId, bool $force = false): FetchDecision
    {
        if ($force) {
            return FetchDecision::allow('forced_by_user');
        }

        $inventory = $this->healthService->getInventory();
        $config = $inventory[$dataset] ?? null;

        if (!$config) {
            return FetchDecision::allow('unknown_dataset');
        }

        // 1. Get record count for status check
        $recordCount = $this->getRecordCount($config, $tournamentId);

        // 2. Static Data Policy: auto-fetch only if empty
        if (($config['is_static'] ?? false) && $recordCount > 0) {
            return FetchDecision::skip('static_data_conservative', 'Statik veri mevcut, otomatik güncelleme devre dışı.');
        }

        // 3. Check Sync Logs
        $logKey = $config['log_key'] ?? $dataset;
        $lastLog = SyncLog::where('tournament_id', $tournamentId)
            ->where('dataset', $logKey)
            ->latest('finished_at')
            ->first();

        if (!$lastLog) {
            return FetchDecision::allow('not_checked');
        }

        if ($lastLog->status === 'failed') {
            return FetchDecision::allow('recovery'); // Retry if previous failed
        }

        // 4. Negative Cache Check (only for successful empty responses)
        if ($recordCount === 0 && $lastLog->status === 'success') {
            $finishedAt = Carbon::parse($lastLog->finished_at);
            if ($finishedAt->addMinutes($config['neg_ttl'] ?? 720)->isFuture()) {
                return FetchDecision::skip('negative_cache_active', 'Son API kontrolü atlandı (Negative cache aktif).');
            }
            return FetchDecision::allow('negative_cache_expired');
        }

        // 5. TTL Check for Dynamic Data
        $finishedAt = Carbon::parse($lastLog->finished_at);
        if ($finishedAt->addMinutes($config['ttl'] ?? 60)->isFuture()) {
            return FetchDecision::skip('ttl_not_expired', 'Son API kontrolü atlandı (TTL dolmadı).');
        }

        return FetchDecision::allow('stale_refresh');
    }

    private function getRecordCount(array $config, int $tournamentId): int
    {
        if (!isset($config['model'])) {
            return 0;
        }

        $query = $config['model']::query()->withoutGlobalScopes();
        $query->where('tournament_id', $tournamentId);

        if (isset($config['filter'])) {
            $query = ($config['filter'])($query);
        }

        return $query->count();
    }
}

/**
 * Helper class for decision result
 */
class FetchDecision
{
    public function __construct(
        public bool $allowed,
        public string $reason,
        public ?string $message = null
    ) {}

    public static function allow(string $reason): self
    {
        return new self(true, $reason);
    }

    public static function skip(string $reason, ?string $message = null): self
    {
        return new self(false, $reason, $message);
    }

    public function isAllowed(): bool
    {
        return $this->allowed;
    }
}
