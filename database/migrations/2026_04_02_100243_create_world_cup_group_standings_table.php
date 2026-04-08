<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_group_standings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();
            $table->foreignId('group_id')->constrained('world_cup_groups')->cascadeOnDelete();
            $table->foreignId('team_id')->constrained('world_cup_teams')->cascadeOnDelete();

            $table->integer('played')->default(0);
            $table->integer('won')->default(0);
            $table->integer('drawn')->default(0);
            $table->integer('lost')->default(0);

            $table->integer('goals_for')->default(0);
            $table->integer('goals_against')->default(0);
            $table->integer('goal_difference')->default(0);
            $table->integer('points')->default(0)->index();
            $table->integer('position')->default(0)->index();

            $table->string('qualified_status')->nullable();
            $table->boolean('visibility_override')->nullable();
            $table->timestamp('snapshot_at')->nullable();

            $table->timestamps();

            $table->unique(['tournament_id', 'group_id', 'team_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_group_standings');
    }
};
