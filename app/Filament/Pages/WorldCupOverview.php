<?php

namespace App\Filament\Pages;

use App\Models\WorldCup\Group;
use App\Models\WorldCup\GroupStanding;
use App\Models\WorldCup\Player;
use App\Models\WorldCup\Stadium;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\WorldCupMatch;
use App\Services\WorldCup\DataHealth\WorldCupDataHealthService;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class WorldCupOverview extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Dünya Kupası Özet';
    protected static ?string $navigationGroup = 'World Cup';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.world-cup-overview';

    protected static ?string $title = 'Dünya Kupası 2026 Operasyon Paneli';

    public ?WorldCup $activeTournament = null;

    /**
     * @var array<string, int>
     */
    public array $overview = [];

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $apiHealth = [];

    public function mount(): void
    {
        $this->loadData();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    private function loadData(): void
    {
        $this->activeTournament = $this->resolveActiveTournament();
        $tournamentId = $this->activeTournament?->id;

        $this->overview = [
            'teams' => $this->countForTournament(Team::class, $tournamentId),
            'matches' => $this->countForTournament(WorldCupMatch::class, $tournamentId),
            'groups' => $this->countForTournament(Group::class, $tournamentId),
            'players' => $this->countForTournament(Player::class, $tournamentId),
            'stadiums' => $this->countForTournament(Stadium::class, $tournamentId),
            'standings' => $this->countForTournament(GroupStanding::class, $tournamentId),
        ];

        $this->apiHealth = app(WorldCupDataHealthService::class)->getHealthReport($tournamentId)->toArray();
    }

    private function resolveActiveTournament(): ?WorldCup
    {
        return WorldCup::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();
    }

    private function countForTournament(string $modelClass, ?int $tournamentId): int
    {
        if ($tournamentId === null) {
            return 0;
        }

        return $modelClass::query()
            ->withoutGlobalScopes()
            ->where('tournament_id', $tournamentId)
            ->count();
    }
}
