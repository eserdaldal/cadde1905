<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();

            $table->string('external_id')->nullable()->index();
            $table->string('stage')->nullable()->index();
            $table->string('round_name')->nullable();
            $table->integer('match_number')->nullable();

            $table->foreignId('home_team_id')->constrained('world_cup_teams')->cascadeOnDelete();
            $table->foreignId('away_team_id')->constrained('world_cup_teams')->cascadeOnDelete();
            $table->foreignId('stadium_id')->nullable()->constrained('world_cup_stadiums')->nullOnDelete();
            $table->foreignId('winner_team_id')->nullable()->constrained('world_cup_teams')->nullOnDelete();

            $table->timestamp('kickoff_at')->nullable()->index();
            $table->string('status')->nullable()->index();

            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->integer('home_penalty_score')->nullable();
            $table->integer('away_penalty_score')->nullable();

            $table->string('referee')->nullable();
            $table->integer('attendance')->nullable();
            $table->text('summary_api')->nullable();
            $table->text('editor_note')->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('featured_lock')->default(false);
            $table->boolean('is_visible')->default(true)->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_matches');
    }
};
