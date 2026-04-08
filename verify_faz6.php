<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tournamentId = 4;
$results = [];

// 1. Total slot assignment count
$slotsFilled = DB::table('world_cup_matches')
    ->where('tournament_id', $tournamentId)
    ->whereNotNull('slot_number')
    ->count();
$results['slots_filled_total'] = $slotsFilled;

// 2. Group stage slots check (1-72)
$groupSlots = DB::table('world_cup_matches')
    ->where('tournament_id', $tournamentId)
    ->whereBetween('slot_number', [1, 72])
    ->count();
$results['group_slots_1_72'] = $groupSlots;

// 3. Stadium ID assignment count (Tournament 4)
$stadiumsAssigned = DB::table('world_cup_matches')
    ->where('tournament_id', $tournamentId)
    ->whereNotNull('stadium_id')
    ->count();
$results['stadiums_assigned_total'] = $stadiumsAssigned;

// 4. Sample check
$match1 = DB::table('world_cup_matches')
    ->where('tournament_id', $tournamentId)
    ->where('slot_number', 1)
    ->first();
$results['match_1_stadium_id'] = $match1 ? $match1->stadium_id : 'MISSING';

$match72 = DB::table('world_cup_matches')
    ->where('tournament_id', $tournamentId)
    ->where('slot_number', 72)
    ->first();
$results['match_72_stadium_id'] = $match72 ? $match72->stadium_id : 'MISSING';

echo json_encode($results, JSON_PRETTY_PRINT);
