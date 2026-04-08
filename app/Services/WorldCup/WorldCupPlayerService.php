<?php

namespace App\Services\WorldCup;

use App\Models\WorldCup\Player;
use App\Models\WorldCup\WorldCup;
use Illuminate\Support\Collection;

class WorldCupPlayerService
{
    public function getIndexData(): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $tournamentId = $activeTournament?->id;

        $players = collect();
        $featuredPlayers = collect();

        if ($tournamentId) {
            $players = Player::query()
                ->with('team')
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_galatasaray_related', true)
                ->orderByDesc('is_featured')
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->get();

            $featuredPlayers = Player::query()
                ->with('team')
                ->where('tournament_id', $tournamentId)
                ->where('is_visible', true)
                ->where('is_galatasaray_related', true)
                ->where('is_featured', true)
                ->orderBy('name_override')
                ->orderBy('name_api')
                ->limit(8)
                ->get();
        }

        $filters = [
            'relation_types' => $this->buildRelationTypeFilters($players),
        ];

        return [
            'activeTournament' => $activeTournament,
            'players' => $this->mapPlayers($players),
            'featuredPlayers' => $this->mapPlayers($featuredPlayers),
            'filters' => $filters,
        ];
    }

    public function getShowData(string $slug): array
    {
        $activeTournament = WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        $player = null;

        if ($activeTournament) {
            $player = Player::query()
                ->with('team')
                ->where('tournament_id', $activeTournament->id)
                ->where('slug', $slug)
                ->where('is_galatasaray_related', true)
                ->first();
        }

        return [
            'activeTournament' => $activeTournament,
            'player' => $this->mapPlayerDetail($player),
        ];
    }

    private function buildRelationTypeFilters(Collection $players): array
    {
        if ($players->isEmpty()) {
            return [];
        }

        return $players
            ->pluck('galatasaray_relation_type')
            ->filter()
            ->map(fn ($value) => trim($value))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function mapPlayers(Collection $players): array
    {
        return $players->map(function (Player $player) {
            return (object) [
                'slug' => $player->slug,
                'name' => $player->name_override ?: $player->name_api,
                'position' => $player->position,
                'gs_squad_number' => null,
                'relation_type' => $player->galatasaray_relation_type,
                'nationalTeam' => (object) [
                    'flag_url' => $player->team?->flag_image_api,
                    'flag_emoji' => '🏳️',
                    'name' => $player->nationality,
                ],
                'team' => (object) [
                    'slug' => $player->team?->slug,
                    'name' => $player->team?->name_override ?: $player->team?->name_api,
                ],
            ];
        })->all();
    }

    private function mapPlayerDetail(?Player $player): ?object
    {
        if (! $player) {
            return null;
        }

        return (object) [
            'slug' => $player->slug,
            'name' => $player->name_override ?: $player->name_api,
            'position' => $player->position,
            'shirt_number' => $player->shirt_number,
            'nationality' => $player->nationality,
            'club' => $player->club_name_normalized ?: $player->club_name_api,
            'relation_type' => $player->galatasaray_relation_type,
            'relation_note' => $player->galatasaray_note,
            'approved_at' => $player->gs_relation_approved_at,
            'team' => $player->team ? (object) [
                'slug' => $player->team->slug,
                'name' => $player->team->name_override ?: $player->team->name_api,
            ] : null,
        ];
    }
}
