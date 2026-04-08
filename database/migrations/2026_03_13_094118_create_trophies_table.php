<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trophies', function (Blueprint $table) {

            $table->id();

            // kupa adı
            $table->string('name');

            // seo slug
            $table->string('slug')->unique();

            // spor branşı
            $table->string('branch')->index();

            // kupa kapsamı
            $table->string('trophy_scope')->nullable()->index();

            // açıklama
            $table->text('description')->nullable();

            // aktif mi
            $table->boolean('is_active')->default(true)->index();

            // sıralama
            $table->integer('sort_order')->default(0)->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trophies');
    }
};