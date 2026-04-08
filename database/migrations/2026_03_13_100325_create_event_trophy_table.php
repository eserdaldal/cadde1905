<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_trophy', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('trophy_id')
                ->constrained('trophies')
                ->cascadeOnDelete();

            // olayın kupa ile ilişkisi
            $table->string('relation_type')->nullable();

            // ek açıklama
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['event_id', 'trophy_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_trophy');
    }
};