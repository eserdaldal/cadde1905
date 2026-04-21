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
                $table->boolean('is_published')->default(true)->index();
            }
            if (! Schema::hasColumn('legends', 'published_at')) {
                $table->timestamp('published_at')->nullable()->index();
            }
            if (! Schema::hasColumn('legends', 'importance_score')) {
                $table->unsignedInteger('importance_score')->default(0)->index();
            }
            if (! Schema::hasColumn('legends', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->index();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('legends')) {
            return;
        }

        Schema::table('legends', function (Blueprint $table) {
            if (Schema::hasColumn('legends', 'is_featured')) {
                $table->dropColumn('is_featured');
            }
            if (Schema::hasColumn('legends', 'importance_score')) {
                $table->dropColumn('importance_score');
            }
            if (Schema::hasColumn('legends', 'published_at')) {
                $table->dropColumn('published_at');
            }
            if (Schema::hasColumn('legends', 'is_published')) {
                $table->dropColumn('is_published');
            }
        });
    }
};
