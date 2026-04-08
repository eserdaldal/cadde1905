<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. world_cup_stadium_aliases
        Schema::create('world_cup_stadium_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stadium_id')->constrained('world_cup_stadiums')->cascadeOnDelete();
            $table->string('alias_name');
            $table->string('alias_city')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();

            $table->unique(['stadium_id', 'alias_name']);
        });

        // 2. world_cup_match_stadium_map
        Schema::create('world_cup_match_stadium_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();
            $table->integer('slot_number');
            $table->foreignId('stadium_id')->constrained('world_cup_stadiums')->cascadeOnDelete();
            $table->string('source')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

            $table->unique(['tournament_id', 'slot_number']);
        });

        // 3. ALTER world_cup_matches
        Schema::table('world_cup_matches', function (Blueprint $table) {
            $table->integer('slot_number')->nullable()->after('match_number');
            $table->string('stadium_mapping_status')->nullable()->after('stadium_id');
            $table->string('stadium_mapping_source')->nullable()->after('stadium_mapping_status');
            $table->string('venue_name_api')->nullable();
            $table->string('venue_city_api')->nullable();
            $table->string('venue_external_id_api')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('world_cup_matches', function (Blueprint $table) {
            $table->dropColumn([
                'slot_number',
                'stadium_mapping_status',
                'stadium_mapping_source',
                'venue_name_api',
                'venue_city_api',
                'venue_external_id_api'
            ]);
        });

        Schema::dropIfExists('world_cup_match_stadium_map');
        Schema::dropIfExists('world_cup_stadium_aliases');
    }
};
