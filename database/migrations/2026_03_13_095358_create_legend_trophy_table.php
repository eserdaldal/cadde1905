<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legend_trophy', function (Blueprint $table) {

            $table->id();

            $table->foreignId('legend_id')
                ->constrained('legends')
                ->cascadeOnDelete();

            $table->foreignId('trophy_id')
                ->constrained('trophies')
                ->cascadeOnDelete();

            $table->smallInteger('year')->index();

            $table->string('role')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['legend_id', 'trophy_id', 'year']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legend_trophy');
    }
};