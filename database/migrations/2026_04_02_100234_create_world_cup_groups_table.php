<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();

            $table->string('external_id')->nullable()->index();
            $table->string('code');
            $table->string('name')->nullable();
            $table->string('stage')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('title_override')->nullable();
            $table->boolean('is_visible')->default(true)->index();

            $table->timestamps();

            $table->unique(['tournament_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_groups');
    }
};
