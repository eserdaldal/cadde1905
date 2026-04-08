<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tournamentId = 4;
$results = [];

// 1. Total Count
$count = DB::table('world_cup_match_stadium_map')->where('tournament_id', $tournamentId)->count();
$results['total_count'] = $count;

// 2. Slot 104 check
$slot104 = DB::table('world_cup_match_stadium_map')
    ->where('tournament_id', $tournamentId)
    ->where('slot_number', 104)
    ->first();
$results['slot_104_stadium'] = $slot104 ? $slot104->stadium_id : 'MISSING';

// 3. Duplicate check
$duplicates = DB::table('world_cup_match_stadium_map')
    ->select('slot_number')
    ->where('tournament_id', $tournamentId)
    ->groupBy('slot_number')
    ->havingRaw('count(*) > 1')
    ->get();
$results['duplicate_slots'] = $duplicates->pluck('slot_number')->toArray();

// 4. Fill check (73-104)
$missing = [];
for ($i = 73; $i <= 104; $i++) {
    $exists = DB::table('world_cup_match_stadium_map')
        ->where('tournament_id', $tournamentId)
        ->where('slot_number', $i)
        ->exists();
    if (!$exists) {
        $missing[] = $i;
    }
}
$results['missing_slots'] = $missing;

echo json_encode($results, JSON_PRETTY_PRINT);
