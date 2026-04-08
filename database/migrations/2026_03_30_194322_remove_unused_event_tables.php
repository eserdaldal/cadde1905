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
        Schema::dropIfExists('event_legend');
        Schema::dropIfExists('event_trophy');
        Schema::dropIfExists('events');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('events', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->smallInteger('year')->index();
            $table->date('event_date')->nullable();
            $table->string('type')->index();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('event_legend', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();
            $table->foreignId('legend_id')
                ->constrained('legends')
                ->cascadeOnDelete();
            $table->string('role')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'legend_id']);
        });

        Schema::create('event_trophy', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();
            $table->foreignId('trophy_id')
                ->constrained('trophies')
                ->cascadeOnDelete();
            $table->string('relation_type')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'trophy_id']);
        });
    }
};
