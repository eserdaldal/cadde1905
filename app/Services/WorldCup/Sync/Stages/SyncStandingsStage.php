<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync\Stages;

use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\Team;
use App\Services\ApiFootball\ApiFootballService;
use App\Services\WorldCup\Sync\SyncStageInterface;
use Illuminate\Support\Carbon;

final class SyncStandingsStage implements SyncStageInterface
{
    public function __construct(private readonly ApiFootballService $api)
    {
    }

    public function name(): string
    {
        return 'standings';
    }

    public function run(array $context): array
    {
        $leagueId = (int) ($context['league_id'] ?? 0);
        $season = (int) ($context['season'] ?? 0);
        $tournamentId = (int) ($context['tournament_id'] ?? 0);
        $tournamentExternalId = (string) ($context['tournament_external_id'] ?? '');

        if ($tournamentId <= 0) {
            throw new \RuntimeException('Tournament kaydı bulunamadı.');
        }

        $teams = Team::withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->whereNotNull('external_id')
            ->get()
            ->keyBy('external_id');

        $data = $this->api->getStandings($leagueId, $season);
        $response = $data['response'][0]['league'] ?? null;

        if (! is_array($response)) {
            throw new \RuntimeException('Standings verisi bulunamadı.');
        }

        $standingsGroups = $response['standings'] ?? [];

        $processed = 0;
        $skipped = 0;
        $warnings = 0;

        if (empty($standingsGroups)) {
            return [
                'processed' => 0,
                'skipped' => 0,
                'warnings' => 1,
                'errors' => 0,
            ];
        }

        foreach ($standingsGroups as $groupRows) {
            if (! is_array($groupRows) || count($groupRows) === 0) {
                continue;
            }

            $groupName = $groupRows[0]['group'] ?? null;
            $groupCode = $this->parseGroupCode((string) $groupName);

            if ($groupCode === null) {
                $warnings++;
                $groupCode = (string) ($groupName ?: 'G');
            }

            $groupExternalId = $tournamentExternalId . '_' . $groupCode;

            $group = Group::withoutGlobalScopes()
                ->where('tournament_id', $tournamentId)
                ->where('external_id', $groupExternalId)
                ->first();

            if (! $group) {
                $group = new Group();
                $group->tournament_id = $tournamentId;
                $group->external_id = $groupExternalId;
            }

            $group->code = $groupCode;
            $group->name = $groupName ?: $group->name;
            $group->stage = $response['round'] ?? $group->stage;
            $group->save();

            foreach ($groupRows as $row) {
                $teamInfo = $row['team'] ?? null;
                if (! is_array($teamInfo)) {
                    $skipped++;
                    continue;
                }

                $teamExternalId = (string) ($teamInfo['id'] ?? '');
                if ($teamExternalId === '') {
                    $skipped++;
                    continue;
                }

                $team = $teams->get($teamExternalId);
                if (! $team) {
                    $warnings++;
                    $skipped++;
                    continue;
                }

                if ($team->group_id !== $group->id) {
                    $team->group_id = $group->id;
                    $team->save();
                }

                $record = GroupStanding::query()
                    ->where('tournament_id', $tournamentId)
                    ->where('group_id', $group->id)
                    ->where('team_id', $team->id)
                    ->first();

                if (! $record) {
                    $record = new GroupStanding();
                    $record->tournament_id = $tournamentId;
                    $record->group_id = $group->id;
                    $record->team_id = $team->id;
                }

                $record->played = (int) ($row['all']['played'] ?? $record->played);
                $record->won = (int) ($row['all']['win'] ?? $record->won);
                $record->drawn = (int) ($row['all']['draw'] ?? $record->drawn);
                $record->lost = (int) ($row['all']['lose'] ?? $record->lost);
                $record->goals_for = (int) ($row['all']['goals']['for'] ?? $record->goals_for);
                $record->goals_against = (int) ($row['all']['goals']['against'] ?? $record->goals_against);
                $record->goal_difference = (int) ($row['goalsDiff'] ?? $record->goal_difference);
                $record->points = (int) ($row['points'] ?? $record->points);
                $record->position = (int) ($row['rank'] ?? $record->position);
                $record->qualified_status = $row['description'] ?? $record->qualified_status;
                $record->snapshot_at = Carbon::now();

                $record->save();
                $processed++;
            }
        }

        return [
            'processed' => $processed,
            'skipped' => $skipped,
            'warnings' => $warnings,
            'errors' => 0,
        ];
    }

    private function parseGroupCode(string $groupName): ?string
    {
        $groupName = trim($groupName);
        if ($groupName === '') {
            return null;
        }

        if (preg_match('/group\s*([a-z])/i', $groupName, $matches)) {
            return strtoupper($matches[1]);
        }

        if (preg_match('/\b([A-L])\b/i', $groupName, $matches)) {
            return strtoupper($matches[1]);
        }

        return null;
    }
}
