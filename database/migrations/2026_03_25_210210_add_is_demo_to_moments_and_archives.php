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
        $tables = ['efsane_moments', 'archive_items'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                if (! Schema::hasColumn($table->getTable(), 'is_demo')) {
                    $table->boolean('is_demo')->default(true)->index();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['efsane_moments', 'archive_items'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'is_demo')) {
                    $table->dropColumn('is_demo');
                }
            });
        }
    }
};
