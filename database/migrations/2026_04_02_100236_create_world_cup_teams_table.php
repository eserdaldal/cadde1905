<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('world_cup_groups')->nullOnDelete();

            $table->string('external_id')->nullable()->index();
            $table->string('name_api');
            $table->string('short_name_api')->nullable();
            $table->string('name_override')->nullable();
            $table->string('short_name_override')->nullable();
            $table->string('slug');
            $table->string('fifa_code')->nullable()->index();
            $table->string('confederation')->nullable();
            $table->string('coach_name_api')->nullable();
            $table->string('flag_image_api')->nullable();
            $table->string('image_override')->nullable();
            $table->text('description_editorial')->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('featured_lock')->default(false);
            $table->boolean('is_visible')->default(true)->index();
            $table->integer('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(['tournament_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_teams');
    }
};
