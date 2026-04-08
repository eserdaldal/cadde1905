<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historical_match_legend', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historical_match_id')
                ->constrained('historical_matches')
                ->cascadeOnDelete();

            $table->foreignId('legend_id')
                ->constrained('legends')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false)->index();
            $table->string('relation_type', 100)->nullable()->index();
            $table->text('notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(
                ['historical_match_id', 'legend_id'],
                'historical_match_legend_unique'
            );
        });

        Schema::create('historical_match_history_event', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historical_match_id')
                ->constrained('historical_matches')
                ->cascadeOnDelete();

            $table->foreignId('history_event_id')
                ->constrained('history_events')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false)->index();
            $table->string('relation_type', 100)->nullable()->index();
            $table->text('notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(
                ['historical_match_id', 'history_event_id'],
                'historical_match_history_event_unique'
            );
        });

        Schema::create('historical_match_trophy', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historical_match_id')
                ->constrained('historical_matches')
                ->cascadeOnDelete();

            $table->foreignId('trophy_id')
                ->constrained('trophies')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false)->index();
            $table->string('relation_type', 100)->nullable()->index();
            $table->text('notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(
                ['historical_match_id', 'trophy_id'],
                'historical_match_trophy_unique'
            );
        });

        Schema::create('historical_match_season_archive', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historical_match_id')
                ->constrained('historical_matches')
                ->cascadeOnDelete();

            $table->foreignId('season_archive_id')
                ->constrained('season_archives')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false)->index();
            $table->string('relation_type', 100)->nullable()->index();
            $table->text('notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(
                ['historical_match_id', 'season_archive_id'],
                'historical_match_season_archive_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historical_match_season_archive');
        Schema::dropIfExists('historical_match_trophy');
        Schema::dropIfExists('historical_match_history_event');
        Schema::dropIfExists('historical_match_legend');
    }
};
