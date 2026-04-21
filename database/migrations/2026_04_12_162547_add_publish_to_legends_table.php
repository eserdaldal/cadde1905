<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('legends')) {
            return;
        }

        Schema::table('legends', function (Blueprint $table) {
            if (! Schema::hasColumn('legends', 'is_published')) {
                $table->boolean('is_published')->default(false)->index();
            }

            if (! Schema::hasColumn('legends', 'published_at')) {
                $table->dateTime('published_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('legends')) {
            return;
        }

        Schema::table('legends', function (Blueprint $table) {
            if (Schema::hasColumn('legends', 'published_at')) {
                $table->dropColumn('published_at');
            }

            if (Schema::hasColumn('legends', 'is_published')) {
                $table->dropColumn('is_published');
            }
        });
    }
};
