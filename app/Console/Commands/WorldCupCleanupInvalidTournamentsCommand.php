<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\WorldCup\WorldCup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class WorldCupCleanupInvalidTournamentsCommand extends Command
{
    protected $signature = 'worldcup:cleanup-invalid-tournaments {--dry-run : Sadece raporla, silme yapma}';

    protected $description = 'World Cup domain içine yanlış düşen turnuvaları güvenli biçimde temizler';

    public function handle(): int
    {
        $targets = WorldCup::withoutGlobalScopes()
            ->where('external_id', '203_2025')
            ->orWhere(function ($query) {
                $query->where('name', 'Süper Lig')
                    ->where('year', 2025);
            })
            ->get();

        if ($targets->isEmpty()) {
            $this->info('Temizlenecek yanlış World Cup turnuvası bulunamadı.');
            return self::SUCCESS;
        }

        $dryRun = (bool) $this->option('dry-run');

        foreach ($targets as $tournament) {
            $tournamentId = $tournament->id;

            $counts = $this->countRelated($tournamentId);

            $this->line('---');
            $this->line('Hedef Turnuva: #' . $tournamentId . ' ' . $tournament->name . ' (' . $tournament->year . ')');
            $this->line('external_id: ' . ($tournament->external_id ?? 'NULL'));
            $this->line('Silinecek kayıt sayıları:');

            foreach ($counts as $table => $count) {
                $this->line(' - ' . $table . ': ' . $count);
            }

            if ($dryRun) {
                $this->warn('Dry-run aktif: silme yapılmadı.');
                continue;
            }

            DB::transaction(function () use ($tournamentId, $counts): void {
                DB::table('world_cup_group_standings')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_matches')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_players')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_teams')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_stadiums')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_groups')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_content_relations')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_settings')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_sync_logs')->where('tournament_id', $tournamentId)->delete();
                DB::table('world_cup_tournaments')->where('id', $tournamentId)->delete();
            });

            $this->info('Silme tamamlandı: tournament #' . $tournamentId);
        }

        return self::SUCCESS;
    }

    /**
     * @return array<string, int>
     */
    private function countRelated(int $tournamentId): array
    {
        return [
            'world_cup_group_standings' => $this->countTable('world_cup_group_standings', $tournamentId),
            'world_cup_matches' => $this->countTable('world_cup_matches', $tournamentId),
            'world_cup_players' => $this->countTable('world_cup_players', $tournamentId),
            'world_cup_teams' => $this->countTable('world_cup_teams', $tournamentId),
            'world_cup_stadiums' => $this->countTable('world_cup_stadiums', $tournamentId),
            'world_cup_groups' => $this->countTable('world_cup_groups', $tournamentId),
            'world_cup_content_relations' => $this->countTable('world_cup_content_relations', $tournamentId),
            'world_cup_settings' => $this->countTable('world_cup_settings', $tournamentId),
            'world_cup_sync_logs' => $this->countTable('world_cup_sync_logs', $tournamentId),
        ];
    }

    private function countTable(string $table, int $tournamentId): int
    {
        return (int) DB::table($table)->where('tournament_id', $tournamentId)->count();
    }
}
