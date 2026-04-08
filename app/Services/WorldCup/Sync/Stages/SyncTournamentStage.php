<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\WorldCup;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Str;

final class SyncTournamentStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'tournament';
    }

    public function run(array $context): array
    {
        $leagueId = (int) ($context['league_id'] ?? 0);
        $season = (int) ($context['season'] ?? 0);

        $data = $this->api->getLeague($leagueId, $season);
        $response = $data['response'][0] ?? null;

        if (! is_array($response)) {
            throw new \RuntimeException('Tournament verisi bulunamadı.');
        }

        $league = $response['league'] ?? [];
        $seasonInfo = $response['seasons'][0] ?? [];

        $name = (string) ($league['name'] ?? 'World Cup');
        $year = (int) ($seasonInfo['year'] ?? $season);
        $externalId = $leagueId . '_' . $season;

        $tournament = WorldCup::withoutGlobalScopes()
            ->where('external_id', $externalId)
            ->first();

        if (! $tournament) {
            $tournament = WorldCup::withoutGlobalScopes()
                ->where('year', $year)
                ->where('slug', Str::slug($name . '-' . $year))
                ->first();
        }

        if (! $tournament) {
            $tournament = new WorldCup();
        }

        $tournament->external_id = $externalId;
        $tournament->name = $name;
        $tournament->year = $year;
        $tournament->host_country = $league['country'] ?? $tournament->host_country;
        $tournament->starts_at = $seasonInfo['start'] ?? $tournament->starts_at;
        $tournament->ends_at = $seasonInfo['end'] ?? $tournament->ends_at;
        $tournament->status = $league['type'] ?? $tournament->status;

        if (! $tournament->slug) {
            $tournament->slug = Str::slug($name . '-' . $year);
        }

        $tournament->save();

        return [
            'processed' => 1,
            'skipped' => 0,
            'warnings' => 0,
            'errors' => 0,
        ];
    }
}
