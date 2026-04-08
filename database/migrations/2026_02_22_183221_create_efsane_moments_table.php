<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('efsane_moments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('legend_id')
                  ->constrained('legends')
                  ->cascadeOnDelete();

            $table->string('title', 200);
            $table->string('slug', 220);

            $table->text('summary')->nullable();
            $table->longText('content')->nullable();

            $table->date('event_date')->nullable();
            $table->unsignedSmallInteger('year')->nullable();

            $table->string('cover_image_path', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['legend_id', 'slug']);
            $table->index(['legend_id', 'event_date']);
            $table->index('year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('efsane_moments');
    }
};
