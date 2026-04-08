<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_stadiums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();

            $table->string('external_id')->nullable()->index();
            $table->string('name_api');
            $table->string('name_override')->nullable();
            $table->string('slug');
            $table->string('city_api')->nullable();
            $table->string('country_api')->nullable();
            $table->integer('capacity')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('image_override')->nullable();
            $table->text('description_editorial')->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_visible')->default(true)->index();

            $table->timestamps();

            $table->unique(['tournament_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_stadiums');
    }
};
