<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Demo/gerçek içerik ayrımı için is_demo alanı eklenir.
     * Not:
     * - after() kullanmıyoruz; cross-db güvenliği için sade bırakıldı.
     * - Kolon zaten varsa tekrar eklenmez.
     */
    public function up(): void
    {
        $tables = [
            'news',
            'timeline_entries',
            'history_events',
            'legends',
            'historical_matches',
            'trophies',
            'season_archives',
        ];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (! Schema::hasColumn($table, 'is_demo')) {
                    $blueprint->boolean('is_demo')->default(false)->index();
                }
            });
        }
    }

    /**
     * Geri alımda kolon varsa kaldırılır.
     */
    public function down(): void
    {
        $tables = [
            'news',
            'timeline_entries',
            'history_events',
            'legends',
            'historical_matches',
            'trophies',
            'season_archives',
        ];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (Schema::hasColumn($table, 'is_demo')) {
                    $blueprint->dropColumn('is_demo');
                }
            });
        }
    }
};