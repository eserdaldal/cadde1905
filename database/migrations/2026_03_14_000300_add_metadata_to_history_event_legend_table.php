<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_event_legend', function (Blueprint $table) {
            $table->boolean('is_primary')
                ->default(false)
                ->after('legend_id')
                ->index();

            $table->string('relation_type', 100)
                ->nullable()
                ->after('is_primary')
                ->index();

            $table->text('notes')
                ->nullable()
                ->after('relation_type');

            $table->unsignedInteger('sort_order')
                ->default(0)
                ->after('notes')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('history_event_legend', function (Blueprint $table) {
            $table->dropIndex(['is_primary']);
            $table->dropIndex(['relation_type']);
            $table->dropIndex(['sort_order']);

            $table->dropColumn([
                'is_primary',
                'relation_type',
                'notes',
                'sort_order',
            ]);
        });
    }
};