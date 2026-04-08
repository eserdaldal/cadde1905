<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "DB: " . DB::getDatabaseName() . "\n";
    $stadiums = DB::table('world_cup_stadiums')->where('tournament_id', 4)->get(['id', 'name']);
    echo "Stadiums count: " . count($stadiums) . "\n";
    foreach ($stadiums as $stadium) {
        echo "{$stadium->id}: {$stadium->name}\n";
    }
    
    $aliases_table = DB::select("SHOW TABLES LIKE 'world_cup_stadium_aliases'");
    if (empty($aliases_table)) {
        echo "Table world_cup_stadium_aliases NOT FOUND\n";
    } else {
        echo "Table world_cup_stadium_aliases FOUND\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
