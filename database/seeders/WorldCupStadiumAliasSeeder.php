<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCupStadiumAliasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aliases = [
            ['alias_name' => 'Dallas Stadium', 'stadium_id' => 42],
            ['alias_name' => 'San Francisco Bay Area Stadium', 'stadium_id' => 43],
            ['alias_name' => 'New York New Jersey Stadium', 'stadium_id' => 32],
            ['alias_name' => 'Mexico City Stadium', 'stadium_id' => 28],
            ['alias_name' => 'Guadalajara Stadium', 'stadium_id' => 29],
            ['alias_name' => 'Monterrey Stadium', 'stadium_id' => 37],
            ['alias_name' => 'Atlanta Stadium', 'stadium_id' => 38],
            ['alias_name' => 'Boston Stadium', 'stadium_id' => 33],
            ['alias_name' => 'Houston Stadium', 'stadium_id' => 35],
            ['alias_name' => 'Kansas City Stadium', 'stadium_id' => 41],
            ['alias_name' => 'Los Angeles Stadium', 'stadium_id' => 31],
            ['alias_name' => 'Miami Stadium', 'stadium_id' => 40],
            ['alias_name' => 'Philadelphia Stadium', 'stadium_id' => 36],
            ['alias_name' => 'Seattle Stadium', 'stadium_id' => 39],
            ['alias_name' => 'Vancouver Stadium', 'stadium_id' => 34],
            ['alias_name' => 'Toronto Stadium', 'stadium_id' => 30],
        ];

        foreach ($aliases as $alias) {
            DB::table('world_cup_stadium_aliases')->updateOrInsert(
                ['alias_name' => $alias['alias_name']],
                [
                    'stadium_id' => $alias['stadium_id'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
