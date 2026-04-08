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
        Schema::dropIfExists('efsane_moment_tag');
        Schema::dropIfExists('efsane_moments');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('efsane_moments', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 220);
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->date('event_date')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('cover_image_path', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable()->index('efsane_moments_created_by_index');
            $table->boolean('is_demo')->default(true)->index('efsane_moments_is_demo_index');
            $table->unique('slug', 'efsane_moments_legend_id_slug_unique');
            $table->index('event_date', 'efsane_moments_legend_id_event_date_index');
            $table->index('year', 'efsane_moments_year_index');
        });

        Schema::create('efsane_moment_tag', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('efsane_moment_id')
                ->constrained('efsane_moments')
                ->cascadeOnDelete();
            $table->foreignId('tag_id')
                ->constrained('tags')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['efsane_moment_id', 'tag_id'], 'efsane_moment_tag_unique');
        });
    }
};
