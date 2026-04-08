<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) status kolonunu ekle
        Schema::table('news', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published'])
                ->default('draft')
                ->after('published_at');
        });

        // 2) Veri migrasyonu (is_published -> status)
        DB::table('news')
            ->where('is_published', 1)
            ->update(['status' => 'published']);

        DB::table('news')
            ->where('is_published', 0)
            ->update(['status' => 'draft']);

        // 3) published ama published_at boşsa doldur
        DB::table('news')
            ->where('status', 'published')
            ->whereNull('published_at')
            ->update(['published_at' => now()]);

        Schema::table('news', function (Blueprint $table) {
            // 4) Eski index’i kaldır
            $table->dropIndex('news_is_published_published_at_index');

            // 5) is_published kolonunu kaldır
            $table->dropColumn('is_published');

            // 6) Yeni index ekle
            $table->index(['status', 'published_at'], 'news_status_published_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->tinyInteger('is_published')
                ->default(0)
                ->after('published_at');
        });

        DB::table('news')
            ->where('status', 'published')
            ->update(['is_published' => 1]);

        DB::table('news')
            ->where('status', 'draft')
            ->update(['is_published' => 0]);

        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('news_status_published_at_index');
            $table->dropColumn('status');
            $table->index(['is_published', 'published_at'], 'news_is_published_published_at_index');
        });
    }
};