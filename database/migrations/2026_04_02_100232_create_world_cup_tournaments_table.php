<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->year('year')->index();
            $table->string('host_country')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('status')->nullable()->index();
            $table->boolean('is_active')->default(false)->index();
            $table->boolean('is_visible')->default(true)->index();

            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('og_image')->nullable();

            $table->timestamps();

            $table->unique(['year', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_tournaments');
    }
};
