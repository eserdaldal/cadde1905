<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCupGroupSlotFillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournamentId = 4; // 2026 World Cup

        // 1-72 aralığındaki grup maçlarını kickoff_at ve id sırasına göre al
        $matches = DB::table('world_cup_matches')
            ->where('tournament_id', $tournamentId)
            ->where('stage', 'LIKE', '%Group Stage%')
            ->orderBy('kickoff_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $filledCount = 0;
        $skippedCount = 0;

        foreach ($matches as $index => $match) {
            $slotNumber = $index + 1;

            // Slot number 72'yi geçmemeli (Group Stage scope)
            if ($slotNumber > 72) {
                break;
            }

            // Eğer slot_number zaten doluysa, overwrite etme ve skip et.
            if (!is_null($match->slot_number)) {
                $skippedCount++;
                continue;
            }

            DB::table('world_cup_matches')
                ->where('id', $match->id)
                ->update([
                    'slot_number' => $slotNumber,
                    'updated_at'  => now(),
                ]);
            
            $filledCount++;
        }

        $this->command->info("Deterministic slot assignment completed. Filled: {$filledCount}, Skipped (Already present): {$skippedCount}.");
    }
}
