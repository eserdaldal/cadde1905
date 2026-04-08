<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mediaables', function (Blueprint $table) {

            $table->id();

            $table->foreignId('media_id')
                ->constrained('media')
                ->cascadeOnDelete();

            $table->string('mediable_type');
            $table->unsignedBigInteger('mediable_id');

            $table->string('usage_type',50);

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_primary')->default(false);

            $table->string('title_override')->nullable();
            $table->text('caption')->nullable();
            $table->string('credit')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['mediable_type','mediable_id']);
            $table->index('usage_type');
            $table->index('sort_order');
            $table->index('is_primary');

            $table->unique(
                ['media_id','mediable_type','mediable_id','usage_type'],
                'media_usage_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mediaables');
    }
};