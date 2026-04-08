<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();
            $table->foreignId('team_id')->constrained('world_cup_teams')->cascadeOnDelete();

            $table->string('external_id')->nullable()->index();
            $table->string('name_api');
            $table->string('name_override')->nullable();
            $table->string('slug');
            $table->string('shirt_number')->nullable();
            $table->string('position')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('club_name_api')->nullable();
            $table->string('club_name_normalized')->nullable();
            $table->string('image_api')->nullable();
            $table->string('image_override')->nullable();
            $table->text('bio_editorial')->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_visible')->default(true)->index();

            $table->boolean('is_galatasaray_related')->default(false)->index();
            $table->string('galatasaray_relation_type')->nullable();
            $table->text('galatasaray_note')->nullable();
            $table->boolean('gs_relation_lock')->default(false);
            $table->timestamp('gs_relation_approved_at')->nullable();

            $table->timestamps();

            $table->unique(['tournament_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_players');
    }
};
