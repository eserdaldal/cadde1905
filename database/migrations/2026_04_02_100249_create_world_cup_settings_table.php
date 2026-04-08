<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')->nullable()->constrained('world_cup_tournaments')->nullOnDelete();

            $table->boolean('wc_module_enabled')->default(true);
            $table->boolean('home_teaser_enabled')->default(true);
            $table->boolean('countdown_enabled')->default(true);
            $table->boolean('show_featured_players')->default(true);
            $table->boolean('show_featured_matches')->default(true);
            $table->boolean('show_featured_stadiums')->default(true);
            $table->boolean('show_stat_cards')->default(true);
            $table->boolean('stale_data_notice_enabled')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_settings');
    }
};
