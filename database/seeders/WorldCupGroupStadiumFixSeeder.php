<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCupGroupStadiumFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournamentId = 4; // 2026 World Cup

        // Canonical Dataset Mapping
        $canonicalMap = [
            1  => 'Mexico City Stadium',
            2  => 'Guadalajara Stadium',
            3  => 'Toronto Stadium',
            4  => 'Los Angeles Stadium',
            5  => 'Boston Stadium',
            6  => 'Vancouver Stadium',
            7  => 'New York New Jersey Stadium',
            8  => 'San Francisco Bay Area Stadium',
            9  => 'Philadelphia Stadium',
            10 => 'Houston Stadium',
            11 => 'Dallas Stadium',
            12 => 'Monterrey Stadium',
            13 => 'Miami Stadium',
            14 => 'Atlanta Stadium',
            15 => 'Los Angeles Stadium',
            16 => 'Seattle Stadium',
            17 => 'New York New Jersey Stadium',
            18 => 'Boston Stadium',
            19 => 'Kansas City Stadium',
            20 => 'San Francisco Bay Area Stadium',
            21 => 'Toronto Stadium',
            22 => 'Dallas Stadium',
            23 => 'Houston Stadium',
            24 => 'Mexico City Stadium',
            25 => 'Atlanta Stadium',
            26 => 'Los Angeles Stadium',
            27 => 'Vancouver Stadium',
            28 => 'Guadalajara Stadium',
            29 => 'Philadelphia Stadium',
            30 => 'Boston Stadium',
            31 => 'San Francisco Bay Area Stadium',
            32 => 'Seattle Stadium',
            33 => 'Toronto Stadium',
            34 => 'Kansas City Stadium',
            35 => 'Houston Stadium',
            36 => 'Monterrey Stadium',
            37 => 'Miami Stadium',
            38 => 'Atlanta Stadium',
            39 => 'Los Angeles Stadium',
            40 => 'Vancouver Stadium',
            41 => 'New York New Jersey Stadium',
            42 => 'Philadelphia Stadium',
            43 => 'Dallas Stadium',
            44 => 'San Francisco Bay Area Stadium',
            45 => 'Boston Stadium',
            46 => 'Toronto Stadium',
            47 => 'Houston Stadium',
            48 => 'Guadalajara Stadium',
            49 => 'Miami Stadium',
            50 => 'Atlanta Stadium',
            51 => 'Vancouver Stadium',
            52 => 'Seattle Stadium',
            53 => 'Mexico City Stadium',
            54 => 'Monterrey Stadium',
            55 => 'Philadelphia Stadium',
            56 => 'New York New Jersey Stadium',
            57 => 'Dallas Stadium',
            58 => 'Kansas City Stadium',
            59 => 'Los Angeles Stadium',
            60 => 'San Francisco Bay Area Stadium',
            61 => 'Boston Stadium',
            62 => 'Toronto Stadium',
            63 => 'Seattle Stadium',
            64 => 'Vancouver Stadium',
            65 => 'Houston Stadium',
            66 => 'Guadalajara Stadium',
            67 => 'New York New Jersey Stadium',
            68 => 'Philadelphia Stadium',
            69 => 'Kansas City Stadium',
            70 => 'Dallas Stadium',
            71 => 'Miami Stadium',
            72 => 'Atlanta Stadium',
        ];

        $updatedCount = 0;
        $alreadyCorrectCount = 0;
        $skippedCount = 0; // ambiguous or unmapped

        foreach ($canonicalMap as $slotNumber => $targetAlias) {
            // Find target stadium_id from alias
            $aliasRecord = DB::table('world_cup_stadium_aliases')
                ->where('alias_name', $targetAlias)
                ->first();

            if (!$aliasRecord) {
                $this->command->error("FAIL: Alias '{$targetAlias}' not found in aliases table for slot {$slotNumber}.");
                $skippedCount++;
                continue;
            }

            $targetStadiumId = $aliasRecord->stadium_id;

            // Find the match record for this slot
            $match = DB::table('world_cup_matches')
                ->where('tournament_id', $tournamentId)
                ->where('slot_number', $slotNumber)
                ->first();

            if (!$match) {
                $this->command->warn("SKIP: Match record for slot {$slotNumber} not found in world_cup_matches.");
                $skippedCount++;
                continue;
            }

            // Already correct check
            if ($match->stadium_id == $targetStadiumId) {
                $alreadyCorrectCount++;
                continue;
            }

            // Safe fix: Update if NULL or wrong
            DB::table('world_cup_matches')
                ->where('id', $match->id)
                ->update([
                    'stadium_id' => $targetStadiumId,
                    'updated_at' => now(),
                ]);
            
            $updatedCount++;
        }

        $this->command->info("Audit completed. Updated: {$updatedCount}, Already Correct: {$alreadyCorrectCount}, Skipped: {$skippedCount}.");
    }
}
