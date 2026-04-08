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
        Schema::table('news', function (Blueprint $table): void {
            $table->dropColumn('cover_image_path');
        });

        Schema::table('historical_matches', function (Blueprint $table): void {
            $table->dropColumn('cover_image_path');
        });

        Schema::table('legends', function (Blueprint $table): void {
            $table->dropColumn('cover_image_path');
        });

        Schema::table('season_archives', function (Blueprint $table): void {
            $table->dropColumn('cover_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->string('cover_image_path')->nullable();
        });

        Schema::table('historical_matches', function (Blueprint $table): void {
            $table->string('cover_image_path')->nullable();
        });

        Schema::table('legends', function (Blueprint $table): void {
            $table->string('cover_image_path')->nullable();
        });

        Schema::table('season_archives', function (Blueprint $table): void {
            $table->string('cover_image_path')->nullable();
        });
    }
};
