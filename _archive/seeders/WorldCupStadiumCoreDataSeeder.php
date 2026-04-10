<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCupStadiumCoreDataSeeder extends Seeder
{
    public function run(): void
    {
        $tournamentId = 4;

        $stadiums = [
            [
                'match_name' => 'Atlanta Stadium',
                'db_name' => 'Mercedes-Benz Stadium',
                'city' => 'Atlanta',
                'country' => 'USA',
                'capacity' => 67382,
            ],
            [
                'match_name' => 'BC Place Vancouver',
                'db_name' => 'BC Place',
                'city' => 'Vancouver',
                'country' => 'Canada',
                'capacity' => 48821,
            ],
            [
                'match_name' => 'Boston Stadium',
                'db_name' => 'Gillette Stadium',
                'city' => 'Foxborough',
                'country' => 'USA',
                'capacity' => 63815,
            ],
            [
                'match_name' => 'Dallas Stadium',
                'db_name' => 'AT&T Stadium',
                'city' => 'Arlington',
                'country' => 'USA',
                'capacity' => 70122,
            ],
            [
                'match_name' => 'Estadio Guadalajara',
                'db_name' => 'Estadio Akron',
                'city' => 'Zapopan',
                'country' => 'Mexico',
                'capacity' => null,
            ],
            [
                'match_name' => 'Estadio Monterrey',
                'db_name' => 'Estadio BBVA',
                'city' => 'Guadalupe',
                'country' => 'Mexico',
                'capacity' => 50113,
            ],
            [
                'match_name' => 'Houston Stadium',
                'db_name' => 'NRG Stadium',
                'city' => 'Houston',
                'country' => 'USA',
                'capacity' => 68311,
            ],
            [
                'match_name' => 'Kansas City Stadium',
                'db_name' => 'Arrowhead Stadium',
                'city' => 'Kansas City',
                'country' => 'USA',
                'capacity' => 67513,
            ],
            [
                'match_name' => 'Los Angeles Stadium',
                'db_name' => 'SoFi Stadium',
                'city' => 'Inglewood',
                'country' => 'USA',
                'capacity' => 69650,
            ],
            [
                'match_name' => 'Mexico City Stadium',
                'db_name' => 'Estadio Azteca',
                'city' => 'Mexico City',
                'country' => 'Mexico',
                'capacity' => 72766,
            ],
            [
                'match_name' => 'Miami Stadium',
                'db_name' => 'Hard Rock Stadium',
                'city' => 'Miami Gardens',
                'country' => 'USA',
                'capacity' => 64091,
            ],
            [
                'match_name' => 'New York New Jersey Stadium',
                'db_name' => 'MetLife Stadium',
                'city' => 'East Rutherford',
                'country' => 'USA',
                'capacity' => 78576,
            ],
            [
                'match_name' => 'Philadelphia Stadium',
                'db_name' => 'Lincoln Financial Field',
                'city' => 'Philadelphia',
                'country' => 'USA',
                'capacity' => 65827,
            ],
            [
                'match_name' => 'San Francisco Bay Area Stadium',
                'db_name' => "Levi's Stadium",
                'city' => 'Santa Clara',
                'country' => 'USA',
                'capacity' => 69391,
            ],
            [
                'match_name' => 'Seattle Stadium',
                'db_name' => 'Lumen Field',
                'city' => 'Seattle',
                'country' => 'USA',
                'capacity' => 65123,
            ],
            [
                'match_name' => 'Toronto Stadium',
                'db_name' => 'BMO Field',
                'city' => 'Toronto',
                'country' => 'Canada',
                'capacity' => 44315,
            ],
        ];

        foreach ($stadiums as $row) {
            $existing = DB::table('world_cup_stadiums')
                ->where('tournament_id', $tournamentId)
                ->where('name_api', $row['db_name'])
                ->first();

            if ($existing) {
                DB::table('world_cup_stadiums')
                    ->where('id', $existing->id)
                    ->update([
                        'name_override' => $row['match_name'],
                        'city_api' => $row['city'],
                        'country_api' => $row['country'],
                        'capacity' => $row['capacity'],
                        'updated_at' => now(),
                    ]);
            } else {
                $this->command?->warn("Eşleşme bulunamadı: {$row['db_name']}");
            }
        }
    }
}