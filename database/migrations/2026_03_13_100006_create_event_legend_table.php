<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_legend', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('legend_id')
                ->constrained('legends')
                ->cascadeOnDelete();

            // olay içindeki rol
            $table->string('role')->nullable();

            // ek açıklama
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['event_id', 'legend_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_legend');
    }
};