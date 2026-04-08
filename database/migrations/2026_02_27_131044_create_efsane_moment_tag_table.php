<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('efsane_moment_tag', function (Blueprint $table) {
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

    public function down(): void
    {
        Schema::dropIfExists('efsane_moment_tag');
    }
};