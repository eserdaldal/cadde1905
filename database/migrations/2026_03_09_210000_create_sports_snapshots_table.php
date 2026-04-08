<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sports_snapshots', function (Blueprint $table): void {
            $table->id();
            $table->string('snapshot_key', 64);
            $table->unsignedBigInteger('team_id');
            $table->unsignedInteger('season');
            $table->json('payload');
            $table->char('checksum', 40);
            $table->timestamp('last_success_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->unique(
                ['snapshot_key', 'team_id', 'season'],
                'sports_snapshots_unique_resource'
            );

            $table->index(['team_id', 'season'], 'sports_snapshots_team_season_index');
            $table->index('expires_at', 'sports_snapshots_expires_at_index');
            $table->index('last_success_at', 'sports_snapshots_last_success_at_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sports_snapshots');
    }
};