<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('news_tag') || ! Schema::hasTable('taggables')) {
            return;
        }

        DB::statement("
            INSERT INTO taggables (tag_id, taggable_type, taggable_id, created_at, updated_at)
            SELECT nt.tag_id, 'App\\\\Models\\\\News', nt.news_id, NOW(), NOW()
            FROM news_tag nt
            LEFT JOIN taggables tg
                ON tg.tag_id = nt.tag_id
                AND tg.taggable_id = nt.news_id
                AND tg.taggable_type = 'App\\\\Models\\\\News'
            WHERE tg.tag_id IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('news_tag') || ! Schema::hasTable('taggables')) {
            return;
        }

        DB::statement("
            DELETE tg
            FROM taggables tg
            INNER JOIN news_tag nt
                ON nt.tag_id = tg.tag_id
                AND nt.news_id = tg.taggable_id
            WHERE tg.taggable_type = 'App\\\\Models\\\\News'
        ");
    }
};
