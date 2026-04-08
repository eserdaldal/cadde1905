<?php

declare(strict_types=1);

namespace App\Services\WorldCup\DataHealth;

use App\Models\WorldCup\Player;
use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\SyncLog;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class WorldCupDataHealthService
{
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_PARTIAL = 'partial';
    public const STATUS_EMPTY_FROM_API = 'empty_from_api';
    public const STATUS_STALE = 'stale';
    public const STATUS_FETCH_FAILED = 'fetch_failed';
    public const STATUS_NOT_CHECKED = 'not_checked';
    public const STATUS_DISABLED = 'disabled';

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function getHealthReport(?int $tournamentId): Collection
    {
        if ($tournamentId === null) {
            return collect();
        }

        return collect($this->getInventory())->map(function ($config, $key) use ($tournamentId) {
            return $this->evaluateDataset($key, $config, $tournamentId);
        });
    }

    public function getInventory(): array
    {
        return [
            'teams' => [
                'label' => 'Takımlar',
                'model' => Team::class,
                'is_static' => true,
                'ttl' => 1440, // 24h
                'neg_ttl' => 720, // 12h
            ],
            'groups' => [
                'label' => 'Gruplar',
                'model' => Group::class,
                'log_key' => 'teams', // Groups come with teams sync
                'is_static' => true,
                'ttl' => 1440,
                'neg_ttl' => 720,
            ],
            'matches' => [
                'label' => 'Maç Fikstürü',
                'model' => WorldCupMatch::class,
                'is_static' => false,
                'ttl' => 30,
                'neg_ttl' => 15,
            ],
            'standings' => [
                'label' => 'Puan Durumu',
                'model' => GroupStanding::class,
                'is_static' => false,
                'ttl' => 15,
                'neg_ttl' => 15,
            ],
            'knockout_matches' => [
                'label' => 'Eleme Turları',
                'model' => WorldCupMatch::class,
                'log_key' => 'matches',
                'filter' => fn($q) => $q->where('stage', 'not like', '%Group%')->orWhere('round_name', 'not like', '%Group%'),
                'is_static' => false,
                'ttl' => 60,
                'neg_ttl' => 120,
            ],
            'stadiums' => [
                'label' => 'Stadyumlar',
                'model' => Stadium::class,
                'is_static' => true,
                'ttl' => 1440,
                'neg_ttl' => 360,
            ],
            'players' => [
                'label' => 'Oyuncu Listeleri',
                'model' => Player::class,
                'is_static' => true,
                'ttl' => 1440,
                'neg_ttl' => 720,
            ],
        ];
    }

    private function evaluateDataset(string $key, array $config, int $tournamentId): array
    {
        if ($config['disabled'] ?? false) {
            return $this->buildReportRow($key, $config, self::STATUS_DISABLED, 'Devre dışı.');
        }

        $logKey = $config['log_key'] ?? $key;
        $lastLog = SyncLog::where('tournament_id', $tournamentId)
            ->where('dataset', $logKey)
            ->latest('finished_at')
            ->first();

        $count = 0;
        if (isset($config['model'])) {
            $query = $config['model']::query();
            if ($config['model'] === WorldCup::class) {
                $query->where('id', $tournamentId);
            } else {
                $query->withoutGlobalScopes()->where('tournament_id', $tournamentId);
            }

            if (isset($config['filter'])) {
                $query = ($config['filter'])($query);
            }
            $count = $query->count();
        }

        $status = self::STATUS_NOT_CHECKED;
        $note = null;

        if (!$lastLog) {
            $status = self::STATUS_NOT_CHECKED;
        } elseif ($lastLog->status === 'failed') {
            $status = self::STATUS_FETCH_FAILED;
            $note = $lastLog->error_summary;
        } elseif ($count === 0 && $lastLog->status === 'success') {
            $status = self::STATUS_EMPTY_FROM_API;
        } else {
            $status = self::STATUS_AVAILABLE;

            // Deep validation for stadiums
            if ($key === 'stadiums') {
                $matchesWithoutStadium = WorldCupMatch::withoutGlobalScopes()
                    ->where('tournament_id', $tournamentId)
                    ->whereNull('stadium_id')
                    ->count();
                if ($matchesWithoutStadium > 0) {
                    $status = self::STATUS_PARTIAL;
                }
            }

            // Stale check (only for dynamic data)
            if (!($config['is_static'] ?? false)) {
                $finishedAt = Carbon::parse($lastLog->finished_at);
                if ($finishedAt->addMinutes($config['ttl'])->isPast()) {
                    $status = self::STATUS_STALE;
                }
            }
        }

        return $this->buildReportRow($key, $config, $status, $note, $lastLog, $count);
    }

    private function buildReportRow(string $key, array $config, string $status, ?string $note, ?SyncLog $log = null, int $count = 0): array
    {
        return [
            'dataset_key' => $key,
            'label' => $config['label'],
            'status' => $status,
            'status_label' => $this->getStatusLabel($status),
            'note' => $note ?: $this->getStatusDescription($status, $key, $count),
            'last_checked_at' => $log?->finished_at?->format('d.m.Y H:i') ?: '-',
            'last_success_at' => ($status !== self::STATUS_FETCH_FAILED && $log) ? $log->finished_at?->format('d.m.Y H:i') : '-',
            'record_count' => $count,
            'status_color' => $this->getStatusColor($status),
        ];
    }

    public function getStatusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_AVAILABLE => 'Hazır',
            self::STATUS_PARTIAL => 'Kısmi',
            self::STATUS_EMPTY_FROM_API => 'Henüz Açıklanmadı',
            self::STATUS_STALE => 'Güncellenmeli',
            self::STATUS_FETCH_FAILED => 'Hata',
            self::STATUS_DISABLED => 'Kapalı',
            default => 'Bekliyor',
        };
    }

    public function getStatusDescription(string $status, string $key, int $count): string
    {
        return match ($status) {
            self::STATUS_AVAILABLE => 'Veriler güncel ve operasyona hazır.',
            self::STATUS_PARTIAL => $key === 'stadiums' ? 'Bazı maçlarda stadyum eşleşmesi eksik.' : 'Veriler eksik görünüyor.',
            self::STATUS_EMPTY_FROM_API => 'API başarılı döndü ancak veri henüz mevcut değil.',
            self::STATUS_STALE => 'Yeni veriler için API kontrol zamanı geldi.',
            self::STATUS_FETCH_FAILED => 'Son bağlantı denemesi başarısız oldu.',
            self::STATUS_DISABLED => 'Bu veri tipi şu an takibe kapalı.',
            self::STATUS_NOT_CHECKED => 'Henüz hiç API sorgusu yapılmadı.',
            default => 'Durum analiz edilemiyor.',
        };
    }

    private function getStatusColor(string $status): string
    {
        return match ($status) {
            self::STATUS_AVAILABLE => 'success', // Green
            self::STATUS_PARTIAL => 'warning',   // Yellow
            self::STATUS_STALE => 'warning',     // Orange (Filament warning is amber/orange)
            self::STATUS_EMPTY_FROM_API => 'gray',
            self::STATUS_FETCH_FAILED => 'danger',
            default => 'gray',
        };
    }
}
