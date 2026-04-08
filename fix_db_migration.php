<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

try {
    if (!Schema::hasColumn('world_cup_matches', 'is_locked')) {
        Schema::table('world_cup_matches', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('is_visible');
        });
        echo "SUCCESS: Column is_locked added.\n";
    } else {
        echo "SUCCESS: Column is_locked already exists.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
