<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\WorldCup\Sync\Stages\SyncStadiumsStage;
use Illuminate\Support\Facades\DB;

$tId = 4;
$results = [];

// 1. Verify SyncStadiumsStage Guard
$stadiumStage = app(SyncStadiumsStage::class);
$stadiumResult = $stadiumStage->run(['tournament_id' => $tId]);
$results['stadium_stage_guard'] = [
    'processed' => $stadiumResult['processed'],
    'note' => $stadiumResult['note'] ?? 'No note',
    'status' => ($stadiumResult['processed'] === 0 && str_contains($stadiumResult['note'] ?? '', 'disabled')) ? 'PASS' : 'FAIL'
];

// 2. Verify SyncMatchesStage Logic for Tournament 4 (Slot 104 - Canonical Map exists)
$canMap104 = DB::table('world_cup_match_stadium_map')
    ->where('tournament_id', 4)
    ->where('slot_number', 104)
    ->first();

$results['guard_104_mapping_check'] = [
    'slot' => 104,
    'has_mapping' => !is_null($canMap104),
    'canonical_stadium_id' => $canMap104 ? $canMap104->stadium_id : null,
    'status' => !is_null($canMap104) ? 'PASS' : 'FAIL (Slot 104 mapping missing?)'
];

echo json_encode($results, JSON_PRETTY_PRINT);
