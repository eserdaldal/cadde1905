<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 120);
            $table->string('slug', 160);
            $table->string('type', 40); // news|legend_moment|heritage|branch

            $table->foreignId('parent_id')->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique('slug');
            $table->index('type');
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
