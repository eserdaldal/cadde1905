<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\ContentRelation;
use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\Player;
use App\Models\WorldCup\Setting;
use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\SyncLog;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Collection;

class WorldCupHomeService
{
    public function __construct(
        protected WorldCupRankingService $rankingService,
        protected WorldCupKnockoutService $knockoutService,
        protected \App\Services\WorldCup\DataHealth\WorldCupDataHealthService $healthService
    ) {}

    public function getHomeData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $settings = null;
        $knockoutHealth = null;

        if ($tournamentId) {
            $settings = Setting::query()
                ->where('tournament_id', $tournamentId)
                ->orderByDesc('id')
                ->first();

            $knockoutHealth = $this->healthService->getHealthReport($tournamentId)
                ->where('dataset_key', 'knockout_matches')
                ->first();
        }

        if (! $settings) {
            $settings = Setting::query()
                ->whereNull('tournament_id')
                ->orderByDesc('id')
                ->first();
        }

        $featuredTeams = collect();
        $featuredMatches = collect();
        $featuredPlayers = collect();
        $featuredStadiums = collect();
        $groups = collect();
        $groupStandings = collect();
        $contentRelations = collect();
        $lastSync = null;
        $qualificationMap = [];

        if ($tournamentId) {
            $featuredTeams = Team::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->limit(6)
                ->get();

            $featuredMatches = WorldCupMatch::query()
                ->with(['homeTeam', 'awayTeam', 'stadium'])
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('kickoff_at')
                ->limit(3)
                ->get();

            $featuredPlayers = Player::query()
                ->with('team')
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderByDesc('updated_at')
                ->limit(5)
                ->get();

            $featuredStadiums = Stadium::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_featured', true)
                ->orderBy('id')
                ->limit(6)
                ->get();

            $groups = Group::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('name', '!=', 'Ranking of third-placed teams')
                ->orderBy('sort_order')
                ->orderBy('code')
                ->get();

            $groupStandings = GroupStanding::query()
                ->with(['group', 'team'])
                ->where('tournament_id', $tournamentId)
                ->whereHas('group', function ($query) {
                    $query->where('name', '!=', 'Ranking of third-placed teams');
                })
                ->orderBy('position')
                ->orderByDesc('points')
                ->get();

            $contentRelations = ContentRelation::query()
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->limit(6)
                ->get();

            $lastSync = SyncLog::query()
                ->where('tournament_id', $tournamentId)
                ->orderByDesc('finished_at')
                ->first();

            $qualificationMap = $this->rankingService->getQualificationMap($tournamentId);
        }

        $heroDateRange = null;

        if ($activeTournament?->starts_at && $activeTournament?->ends_at) {
            $heroDateRange = $activeTournament->starts_at->format('d M') . ' – ' . $activeTournament->ends_at->format('d M Y');
        }

        $lastSyncLabel = null;

        if ($lastSync?->finished_at) {
            $lastSyncLabel = $lastSync->finished_at->format('d M Y H:i');

            if ($lastSync?->status) {
                $lastSyncLabel .= ' · ' . $lastSync->status;
            }
        }

        $freshnessMeta = [
            'last_sync_at' => $lastSync?->finished_at,
            'status' => $lastSync?->status,
        ];

        return [
            'activeTournament' => $activeTournament,
            'heroDateRange' => $heroDateRange,
            'lastSyncLabel' => $lastSyncLabel,
            'settings' => $settings,
            'featuredTeams' => $featuredTeams,
            'featuredMatches' => $this->mapMatches($featuredMatches),
            'featuredPlayers' => $this->mapPlayers($featuredPlayers),
            'featuredStadiums' => $this->mapStadiums($featuredStadiums),
            'groups' => $groups,
            'groupStandings' => $this->mapGroupStandings($groupStandings, $qualificationMap),
            'contentRelations' => $contentRelations,
            'freshnessMeta' => $freshnessMeta,
            'knockoutData' => $this->knockoutService->getKnockoutData($tournamentId),
            'knockoutHealth' => $knockoutHealth,
        ];
    }

    private function mapGroupStandings(Collection $standings, array $qualificationMap): Collection
    {
        return $standings->map(function ($standing) use ($qualificationMap) {
            $qualification = $qualificationMap[$standing->team_id] ?? null;

            return (object) [
                'tournament_id' => $standing->tournament_id,
                'group_id' => $standing->group_id,
                'team_id' => $standing->team_id,
                'played' => $standing->played,
                'won' => $standing->won,
                'drawn' => $standing->drawn,
                'lost' => $standing->lost,
                'points' => $standing->points,
                'goals_for' => $standing->goals_for,
                'goals_against' => $standing->goals_against,
                'position' => $standing->position,
                'group' => $standing->group,
                'team' => (object) [
                    'id' => $standing->team_id,
                    'slug' => $standing->team?->slug,
                    'name_override' => $standing->team?->name_override,
                    'name_api' => $standing->team?->name_api,
                    'flag_url' => $standing->team?->flag_image_api,
                    'qualification' => $qualification ? (object) $qualification : null,
                ],
            ];
        });
    }

    private function mapMatches(Collection $matches): array
    {
        return $matches->map(function (WorldCupMatch $match) {
            $homeTeam = $match->homeTeam;
            $awayTeam = $match->awayTeam;
            $stadium = $match->stadium;
            $kickoffAt = $match->kickoff_at;

            return (object) [
                'id' => $match->id,
                'round' => $match->round_name ?: $match->stage,
                'date' => $match->kickoff_at,
                'date_label' => $kickoffAt?->format('d M, H:i'),
                'home_score' => $match->home_score,
                'away_score' => $match->away_score,
                'homeTeam' => (object) [
                    'name' => $homeTeam ? ($homeTeam->name_override ?: $homeTeam->name_api) : null,
                    'flag_url' => $homeTeam?->flag_image_api,
                ],
                'awayTeam' => (object) [
                    'name' => $awayTeam ? ($awayTeam->name_override ?: $awayTeam->name_api) : null,
                    'flag_url' => $awayTeam?->flag_image_api,
                ],
                'stadium' => (object) [
                    'name' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
                    'city' => $stadium?->city_api,
                ],
            ];
        })->all();
    }

    private function mapPlayers(Collection $players): array
    {
        return $players->map(function (Player $player) {
            return (object) [
                'slug' => $player->slug,
                'name' => $player->name_override ?: $player->name_api,
                'position' => $player->position,
                'gs_squad_number' => null,
                'nationalTeam' => (object) [
                    'flag_url' => $player->team?->flag_image_api,
                    'name' => $player->nationality,
                ],
            ];
        })->all();
    }

    private function mapStadiums(Collection $stadiums): array
    {
        return $stadiums->map(function (Stadium $stadium) {
            return (object) [
                'slug' => $stadium->slug,
                'name' => $stadium->name_override ?: $stadium->name_api,
                'city' => $stadium->city_api,
                'country' => $stadium->country_api,
                'capacity' => $stadium->capacity,
            ];
        })->all();
    }
}
