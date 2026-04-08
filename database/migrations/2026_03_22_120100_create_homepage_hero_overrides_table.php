<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_hero_overrides', function (Blueprint $table): void {
            $table->id();

            $table->string('item_type', 100);
            $table->unsignedBigInteger('item_id');
            $table->string('content_key', 150);

            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at');

            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by');

            $table->string('notes', 255)->nullable();

            $table->timestamps();

            $table->index(['is_active', 'starts_at', 'ends_at'], 'idx_hho_active_window');
            $table->index(['item_type', 'item_id'], 'idx_hho_item');
            $table->index(['content_key'], 'idx_hho_content_key');
            $table->index(['created_by'], 'idx_hho_created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_hero_overrides');
    }
};
