<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\Group;
use App\Models\WorldCup\Team;

class WorldCupDemoSeeder extends Seeder
{
    public function run(): void
    {
        $wc = WorldCup::create([
            'name' => 'FIFA World Cup 2022',
            'slug' => 'fifa-world-cup-2022',
            'year' => 2022,
            'is_active' => 1,
            'is_visible' => 1,
        ]);

        $group = Group::create([
            'tournament_id' => $wc->id,
            'code' => 'A',
            'name' => 'Group A',
            'is_visible' => 1,
        ]);

        Team::insert([
            [
                'tournament_id' => $wc->id,
                'group_id' => $group->id,
                'name_api' => 'France',
                'slug' => 'france',
                'is_visible' => 1,
                'is_featured' => 1,
            ],
            [
                'tournament_id' => $wc->id,
                'group_id' => $group->id,
                'name_api' => 'Argentina',
                'slug' => 'argentina',
                'is_visible' => 1,
                'is_featured' => 1,
            ],
        ]);
    }
}