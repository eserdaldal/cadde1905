<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('season_archive_legend', function (Blueprint $table) {

            $table->id();

            $table->foreignId('season_archive_id')->constrained()->cascadeOnDelete();
            $table->foreignId('legend_id')->constrained()->cascadeOnDelete();

            $table->boolean('is_primary')->default(false);
            $table->string('relation_type')->nullable();
            $table->text('notes')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->unique([
                'season_archive_id',
                'legend_id'
            ], 'season_archive_legend_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('season_archive_legend');
    }
};
