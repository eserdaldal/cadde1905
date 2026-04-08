<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_sync_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')->nullable()->constrained('world_cup_tournaments')->nullOnDelete();

            $table->string('dataset')->index();
            $table->string('source')->default('api-football');
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();

            $table->integer('records_processed')->default(0);
            $table->integer('records_skipped')->default(0);
            $table->integer('warnings_count')->default(0);
            $table->integer('errors_count')->default(0);

            $table->string('status')->index();
            $table->text('error_summary')->nullable();
            $table->string('batch_uuid')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_sync_logs');
    }
};
