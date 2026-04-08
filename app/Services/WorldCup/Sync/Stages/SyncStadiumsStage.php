<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\Stadium;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Str;

final class SyncStadiumsStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'stadiums';
    }

    public function run(array $context): array
    {
        $leagueId = (int) ($context['league_id'] ?? 0);
        $season = (int) ($context['season'] ?? 0);
        $tournamentId = (int) ($context['tournament_id'] ?? 0);

        if ($tournamentId <= 0) {
            throw new \RuntimeException('Tournament kaydı bulunamadı.');
        }

        // FAZ 7 — Guard: 2026 World Cup (Tournament ID 4) için stadyum sync devre dışı bırakıldı.
        // Bu turnuva için stadyumlar kanonik modelden (master data) yönetilmektedir.
        if ($tournamentId === 4) {
            return [
                'processed' => 0,
                'skipped' => 0,
                'warnings' => 0,
                'errors' => 0,
                'note' => '2026 World Cup stadium sync is disabled (Canonical Guard Active).',
            ];
        }

        $data = $this->api->getFixtures($leagueId, $season);
        $rows = $data['response'] ?? [];

        $venues = [];
        $warnings = 0;

        foreach ($rows as $row) {
            $fixture = $row['fixture'] ?? [];
            $venue = $fixture['venue'] ?? null;

            if (! is_array($venue)) {
                continue;
            }

            $name = trim((string) ($venue['name'] ?? ''));
            $city = trim((string) ($venue['city'] ?? ''));
            $externalId = $venue['id'] ?? null;

            if ($name === '') {
                continue;
            }

            $key = $externalId ? ('id:' . $externalId) : ('hash:' . sha1(mb_strtolower($name) . '|' . mb_strtolower($city)));

            $venues[$key] = [
                'external_id' => $externalId ? (string) $externalId : null,
                'name_api' => $name,
                'city_api' => $city !== '' ? $city : null,
                'country_api' => $venue['country'] ?? null,
                'capacity' => $venue['capacity'] ?? null,
                'latitude' => $venue['latitude'] ?? null,
                'longitude' => $venue['longitude'] ?? null,
                'slug' => Str::slug($name),
                'fallback_key' => $externalId ? null : $key,
            ];
        }

        $processed = 0;
        $skipped = 0;

        if (empty($venues)) {
            return [
                'processed' => 0,
                'skipped' => 0,
                'warnings' => 1,
                'errors' => 0,
            ];
        }

        foreach ($venues as $venue) {
            $externalId = $venue['external_id'] ?? null;

            if (! $externalId && isset($venue['fallback_key'])) {
                $externalId = $venue['fallback_key'];
                $warnings++;
            }

            if (! $externalId) {
                $skipped++;
                continue;
            }

            $record = Stadium::withoutGlobalScopes()
                ->where('tournament_id', $tournamentId)
                ->where('external_id', $externalId)
                ->first();

            if (! $record) {
                $record = new Stadium();
                $record->tournament_id = $tournamentId;
                $record->external_id = $externalId;
            }

            $record->name_api = $venue['name_api'];
            $record->city_api = $venue['city_api'];
            $record->country_api = $venue['country_api'];
            $record->capacity = $venue['capacity'];
            $record->latitude = $venue['latitude'];
            $record->longitude = $venue['longitude'];

            if (! $record->slug) {
                $record->slug = $this->resolveUniqueSlug($venue['slug'], $tournamentId, $record->id);
            }

            $record->save();
            $processed++;
        }

        return [
            'processed' => $processed,
            'skipped' => $skipped,
            'warnings' => $warnings,
            'errors' => 0,
        ];
    }

    private function resolveUniqueSlug(string $baseSlug, int $tournamentId, ?int $recordId): string
    {
        $slug = $baseSlug !== '' ? $baseSlug : Str::random(8);
        $counter = 1;

        while (Stadium::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->where('slug', $slug)
            ->when($recordId, fn ($query) => $query->where('id', '!=', $recordId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
