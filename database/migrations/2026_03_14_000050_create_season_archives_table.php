<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('season_archives', function (Blueprint $table) {
            $table->id();

            $table->string('title', 220);
            $table->string('slug')->unique();

            $table->string('season_label', 50)->index();
            $table->unsignedSmallInteger('start_year')->nullable()->index();
            $table->unsignedSmallInteger('end_year')->nullable()->index();

            $table->boolean('is_published')->default(true)->index();
            $table->timestamp('published_at')->nullable()->index();

            $table->text('summary')->nullable();
            $table->longText('content')->nullable();

            $table->text('season_overview')->nullable();
            $table->text('league_summary')->nullable();
            $table->text('europe_summary')->nullable();
            $table->text('cup_summary')->nullable();

            $table->string('manager_name', 255)->nullable();
            $table->text('notes')->nullable();
            $table->text('editorial_note')->nullable();

            $table->string('cover_image_path')->nullable();
            $table->unsignedInteger('importance_score')->default(0)->index();
            $table->boolean('is_featured')->default(false)->index();

            $table->unsignedBigInteger('created_by')->nullable()->index();

            $table->timestamps();

            $table->index(
                ['start_year', 'end_year'],
                'season_archives_start_end_year_index'
            );

            $table->foreign('created_by', 'fk_season_archives_created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('season_archives');
    }
};
