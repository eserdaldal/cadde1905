<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cup_content_relations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')->constrained('world_cup_tournaments')->cascadeOnDelete();

            $table->string('related_type');
            $table->unsignedBigInteger('related_id');
            $table->string('relation_type')->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_visible')->default(true)->index();
            $table->integer('sort_order')->default(0)->index();

            $table->timestamps();

            $table->index(['related_type', 'related_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world_cup_content_relations');
    }
};
