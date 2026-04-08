<?php

use App\Models\WorldCup\WorldCupMatch;
use App\Models\WorldCup\Team;
use App\Models\WorldCup\Player;
use App\Models\WorldCup\Stadium;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tournamentId = 4;

$data = [
    'matches' => WorldCupMatch::where('tournament_id', $tournamentId)->count(),
    'matches_no_stadium' => WorldCupMatch::where('tournament_id', $tournamentId)->whereNull('stadium_id')->count(),
    'teams' => Team::where('tournament_id', $tournamentId)->count(),
    'players' => Player::where('tournament_id', $tournamentId)->count(),
    'stadiums' => Stadium::where('tournament_id', $tournamentId)->count(),
    'knockout' => WorldCupMatch::where('tournament_id', $tournamentId)
        ->where(function($q) {
            $q->where('stage', 'not like', '%Group%')
              ->orWhere('round_name', 'not like', '%Group%');
        })->count(),
];

echo json_encode($data, JSON_PRETTY_PRINT);
