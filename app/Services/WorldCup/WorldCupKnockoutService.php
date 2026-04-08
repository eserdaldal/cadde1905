<?php

declare(strict_types=1);

namespace App\Services\WorldCup;

use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCupMatch;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class WorldCupKnockoutService
{
    private const KNOCKOUT_KEYWORDS = ['Round', 'Final', 'Semi', 'Quarter', 'Playoff'];
    private const EXCLUDE_KEYWORDS = ['Group'];

    /**
     * @return array{rounds: array<int, array{key: string, label: string, matches: Collection}>}
     */
    public function getKnockoutData(int $tournamentId): array
    {
        $matches = WorldCupMatch::with(['homeTeam', 'awayTeam', 'stadium'])
            ->where('tournament_id', $tournamentId)
            ->get()
            ->filter(fn (WorldCupMatch $match) => $this->isKnockout($match))
            ->sortBy('kickoff_at');

        if ($matches->isEmpty()) {
            return ['rounds' => []];
        }

        $mappedMatches = $matches->map(fn (WorldCupMatch $match) => $this->mapMatch($match));
        $grouped = $mappedMatches->groupBy('round_key');

        $roundOrder = [
            'round_of_32' => 'Son 32',
            'round_of_16' => 'Son 16',
            'quarter_final' => 'Çeyrek Final',
            'semi_final' => 'Yarı Final',
            'third_place' => 'Üçüncülük Maçı',
            'final' => 'Final',
        ];

        $rounds = [];
        foreach ($roundOrder as $key => $label) {
            if ($grouped->has($key)) {
                $rounds[] = [
                    'key' => $key,
                    'label' => $label,
                    'matches' => $grouped->get($key),
                ];
            }
        }

        // Add any non-standard rounds that might have been matched but not in $roundOrder
        foreach ($grouped as $key => $matchesInRound) {
            if (! isset($roundOrder[$key])) {
                $rounds[] = [
                    'key' => $key,
                    'label' => Str::headline($key),
                    'matches' => $matchesInRound,
                ];
            }
        }

        return ['rounds' => $rounds];
    }

    private function mapMatch(WorldCupMatch $match): object
    {
        $homeTeam = $match->homeTeam;
        $awayTeam = $match->awayTeam;
        $stadium = $match->stadium;

        return (object) [
            'id' => $match->id,
            'round_key' => $this->normalizeStage($match),
            'round_label' => $match->round_name ?: $match->stage ?: 'Maç',
            'kickoff_at' => $match->kickoff_at,
            'kickoff_label' => $match->kickoff_at?->format('d M, H:i'),
            'home_score' => $match->home_score,
            'away_score' => $match->away_score,
            'status' => $match->status,
            'homeTeam' => $this->mapTeam($homeTeam, 'Ev Sahibi'),
            'awayTeam' => $this->mapTeam($awayTeam, 'Deplasman'),
            'stadium' => (object) [
                'name' => $stadium ? ($stadium->name_override ?: $stadium->name_api) : null,
                'city' => $stadium?->city_api,
            ],
        ];
    }

    private function mapTeam(?Team $team, string $placeholder): object
    {
        if (! $team) {
            return (object) [
                'name' => 'Belli Değil',
                'flag_url' => null,
                'is_placeholder' => true,
            ];
        }

        $name = $team->name_override ?: $team->name_api;
        $isPlaceholder = $this->isPlaceholderName($name);

        return (object) [
            'name' => $isPlaceholder ? 'Belli Değil' : $name,
            'original_name' => $name,
            'flag_url' => $isPlaceholder ? null : $team->flag_image_api,
            'is_placeholder' => $isPlaceholder,
        ];
    }

    private function isPlaceholderName(?string $name): bool
    {
        if (! $name) return true;

        $placeholders = ['Winner', 'Runner-up', 'TBD', 'TBC', 'Match', 'Group'];
        foreach ($placeholders as $p) {
            if (Str::contains($name, $p, true)) {
                return true;
            }
        }

        return false;
    }

    private function isKnockout(WorldCupMatch $match): bool
    {
        $stage = (string) $match->stage;
        $roundName = (string) $match->round_name;

        $target = $roundName !== '' ? $roundName : $stage;

        foreach (self::EXCLUDE_KEYWORDS as $keyword) {
            if (Str::contains($target, $keyword, true)) {
                return false;
            }
        }

        foreach (self::KNOCKOUT_KEYWORDS as $keyword) {
            if (Str::contains($target, $keyword, true)) {
                return true;
            }
        }

        return false;
    }

    private function normalizeStage(WorldCupMatch $match): string
    {
        $target = (string) ($match->round_name !== '' ? $match->round_name : $match->stage);
        $target = Str::lower($target);

        if (Str::contains($target, '32')) return 'round_of_32';
        if (Str::contains($target, '16')) return 'round_of_16';
        if (Str::contains($target, 'quarter')) return 'quarter_final';
        if (Str::contains($target, 'semi')) return 'semi_final';
        if (Str::contains($target, 'third') || Str::contains($target, '3rd')) return 'third_place';
        if (Str::contains($target, 'final') && ! Str::contains($target, 'quarter') && ! Str::contains($target, 'semi')) return 'final';

        return Str::slug($target);
    }
}
