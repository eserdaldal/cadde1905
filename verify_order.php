<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tId = 4;
$hostMek = DB::table('world_cup_teams')->where('name_api', 'Mexico')->value('id');
$hostCan = DB::table('world_cup_teams')->where('name_api', 'Canada')->value('id');
$hostUSA = DB::table('world_cup_teams')->where('name_api', 'United States')->value('id');

echo "Host IDs - MEK: $hostMek, CAN: $hostCan, USA: $hostUSA\n";

$matches = DB::table('world_cup_matches')
    ->where('tournament_id', $tId)
    ->orderBy('kickoff_at')
    ->get(['id', 'kickoff_at', 'home_team_id', 'away_team_id']);

foreach ($matches as $idx => $m) {
    echo ($idx + 1) . ". ID: {$m->id} | Date: {$m->kickoff_at} | Home: {$m->home_team_id}\n";
    if ($idx >= 3) break;
}
