<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_event_trophy', function (Blueprint $table) {
            $table->id();

            $table->foreignId('history_event_id')
                ->constrained('history_events')
                ->cascadeOnDelete();

            $table->foreignId('trophy_id')
                ->constrained('trophies')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false);
            $table->string('relation_type')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'history_event_id',
                'trophy_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_event_trophy');
    }
};
