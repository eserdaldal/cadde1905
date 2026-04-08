<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->restrictOnDelete();

            $table->foreignId('author_user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->string('branch', 20)->default('futbol');

            $table->string('title', 200);
            $table->string('slug', 220);

            $table->text('summary')->nullable();
            $table->longText('content');

            $table->string('cover_image_path', 255)->nullable();
            $table->string('source_url', 500)->nullable();

            $table->dateTime('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_ai_generated')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->unique('slug');

            $table->index(['category_id', 'published_at']);
            $table->index(['author_user_id', 'published_at']);
            $table->index(['branch', 'published_at']);
            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
