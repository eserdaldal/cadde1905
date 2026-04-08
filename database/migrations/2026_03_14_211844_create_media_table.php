<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('media_kind',20);
            $table->string('storage_type',20);

            $table->string('disk',50)->nullable();
            $table->string('path',500)->nullable();

            $table->string('original_name')->nullable();
            $table->string('extension',20)->nullable();

            $table->string('mime_type',100)->nullable();

            $table->unsignedBigInteger('size')->nullable();

            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();

            $table->unsignedInteger('duration_seconds')->nullable();

            $table->string('embed_provider',50)->nullable();
            $table->string('embed_url',1000)->nullable();

            $table->string('poster_path',500)->nullable();

            $table->string('alt_text',500)->nullable();

            $table->string('checksum',128)->nullable();

            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('media_kind');
            $table->index('storage_type');
            $table->index('is_active');
            $table->index('created_by');
            $table->index('checksum');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};