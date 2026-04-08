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
        Schema::dropIfExists('archive_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('archive_items', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_path')->nullable();
            $table->date('event_date')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->boolean('is_demo')->default(true)->index();
        });
    }
};
