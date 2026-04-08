<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCupMatchSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournamentId = 4; // 2026 World Cup
        
        $killSwitch = false;

        $mappings = [
            // Final
            ['slot_number' => 104, 'stadium_id' => 32], // NYNJ
            // Bronze
            ['slot_number' => 103, 'stadium_id' => 40], // Miami
            // Semis
            ['slot_number' => 102, 'stadium_id' => 38], // Atlanta
            ['slot_number' => 101, 'stadium_id' => 42], // Dallas
            // Quarters
            ['slot_number' => 100, 'stadium_id' => 40], // Miami
            ['slot_number' => 99, 'stadium_id' => 41],  // KC
            ['slot_number' => 98, 'stadium_id' => 31],  // LA
            ['slot_number' => 97, 'stadium_id' => 33],  // Boston
            // R16
            ['slot_number' => 96, 'stadium_id' => 38],  // Atlanta
            ['slot_number' => 95, 'stadium_id' => 32],  // NYNJ
            ['slot_number' => 94, 'stadium_id' => 36],  // Philly
            ['slot_number' => 93, 'stadium_id' => 42],  // Dallas
            ['slot_number' => 92, 'stadium_id' => 35],  // Houston
            ['slot_number' => 91, 'stadium_id' => 28],  // Mexico City
            ['slot_number' => 90, 'stadium_id' => 34],  // Vancouver
            ['slot_number' => 89, 'stadium_id' => 39],  // Seattle
            // R32
            ['slot_number' => 88, 'stadium_id' => 29],  // Guadalajara
            ['slot_number' => 87, 'stadium_id' => 40],  // Miami
            ['slot_number' => 86, 'stadium_id' => 41],  // KC
            ['slot_number' => 85, 'stadium_id' => 38],  // Atlanta
            ['slot_number' => 84, 'stadium_id' => 34],  // Vancouver
            ['slot_number' => 83, 'stadium_id' => 39],  // Seattle
            ['slot_number' => 82, 'stadium_id' => 28],  // Mexico City
            ['slot_number' => 81, 'stadium_id' => 42],  // Dallas
            ['slot_number' => 80, 'stadium_id' => 35],  // Houston
            ['slot_number' => 79, 'stadium_id' => 36],  // Philly
            ['slot_number' => 78, 'stadium_id' => 32],  // NYNJ
            ['slot_number' => 77, 'stadium_id' => 30],  // Toronto
            ['slot_number' => 76, 'stadium_id' => 33],  // Boston
            ['slot_number' => 75, 'stadium_id' => 43],  // SF
            ['slot_number' => 74, 'stadium_id' => 31],  // LA
            ['slot_number' => 73, 'stadium_id' => 37],  // Monterrey
        ];

        // Validasyon: Stadium ID'lerin varlığı kontrol ediliyor.
        $stadiumIds = DB::table('world_cup_stadiums')->pluck('id')->toArray();
        foreach ($mappings as $mapping) {
            if (!in_array($mapping['stadium_id'], $stadiumIds)) {
                $this->command->error("FAIL: Stadium ID {$mapping['stadium_id']} for slot {$mapping['slot_number']} not found in world_cup_stadiums.");
                $killSwitch = true;
            }
        }

        if ($killSwitch) {
            $this->command->error("Aborting seeder due to validation errors.");
            return;
        }

        $addedCount = 0;
        $skippedCount = 0;

        foreach ($mappings as $mapping) {
            $exists = DB::table('world_cup_match_stadium_map')
                ->where('tournament_id', $tournamentId)
                ->where('slot_number', $mapping['slot_number'])
                ->exists();

            if ($exists) {
                $skippedCount++;
                continue;
            }

            DB::table('world_cup_match_stadium_map')->insert([
                'tournament_id' => $tournamentId,
                'slot_number'   => $mapping['slot_number'],
                'stadium_id'    => $mapping['stadium_id'],
                'source'        => 'canonical_2026_knockout',
                'is_locked'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
            $addedCount++;
        }

        $this->command->info("Seeding completed. Added: {$addedCount}, Skipped: {$skippedCount}.");
    }
}
