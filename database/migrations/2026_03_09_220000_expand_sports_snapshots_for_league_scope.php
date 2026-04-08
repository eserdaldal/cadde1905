<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sports_snapshots', function (Blueprint $table): void {
            $table->string('scope_type', 32)->default('team')->after('snapshot_key');
            $table->unsignedBigInteger('scope_id')->nullable()->after('scope_type');
            $table->unsignedInteger('result_limit')->default(0)->after('season');
        });

        DB::table('sports_snapshots')
            ->whereNull('scope_id')
            ->update([
                'scope_id' => DB::raw('team_id'),
                'scope_type' => 'team',
                'result_limit' => 0,
            ]);

        Schema::table('sports_snapshots', function (Blueprint $table): void {
            $table->dropUnique('sports_snapshots_unique_resource');

            $table->unique(
                ['snapshot_key', 'scope_type', 'scope_id', 'season', 'result_limit'],
                'sports_snapshots_unique_scope'
            );

            $table->index(
                ['scope_type', 'scope_id', 'season'],
                'sports_snapshots_scope_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('sports_snapshots', function (Blueprint $table): void {
            $table->dropUnique('sports_snapshots_unique_scope');
            $table->dropIndex('sports_snapshots_scope_index');

            $table->unique(
                ['snapshot_key', 'team_id', 'season'],
                'sports_snapshots_unique_resource'
            );

            $table->dropColumn(['scope_type', 'scope_id', 'result_limit']);
        });
    }
};