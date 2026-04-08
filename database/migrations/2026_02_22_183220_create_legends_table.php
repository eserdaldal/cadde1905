<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legends', function (Blueprint $table) {
            $table->id();

            $table->string('name', 160);
            $table->string('slug', 180);

            $table->string('title', 200)->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();

            $table->string('cover_image_path', 255)->nullable();
            $table->unsignedSmallInteger('era_start_year')->nullable();
            $table->unsignedSmallInteger('era_end_year')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique('slug');
            $table->index('era_start_year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legends');
    }
};
