<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Sadece referenced kayıtlar için unique constraint
        // MySQL partial index desteklemez, bu yüzden generated column kullanıyoruz

        DB::statement("
            ALTER TABLE timeline_entries
            ADD COLUMN referenced_key VARCHAR(255) GENERATED ALWAYS AS (
                CASE
                    WHEN source_type IS NOT NULL AND source_id IS NOT NULL
                    THEN CONCAT(source_type, '#', source_id, '#', DATE(timeline_date))
                    ELSE NULL
                END
            ) STORED
        ");

        Schema::table('timeline_entries', function (Blueprint $table) {
            $table->unique('referenced_key', 'timeline_entries_referenced_unique');
        });
    }

    public function down(): void
    {
        Schema::table('timeline_entries', function (Blueprint $table) {
            $table->dropUnique('timeline_entries_referenced_unique');
        });

        DB::statement("
            ALTER TABLE timeline_entries
            DROP COLUMN referenced_key
        ");
    }
};