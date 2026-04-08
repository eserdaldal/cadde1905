<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_event_legend', function (Blueprint $table) {

            $table->id();

            $table->foreignId('history_event_id')
                ->constrained('history_events')
                ->cascadeOnDelete();

            $table->foreignId('legend_id')
                ->constrained('legends')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'history_event_id',
                'legend_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_event_legend');
    }
};