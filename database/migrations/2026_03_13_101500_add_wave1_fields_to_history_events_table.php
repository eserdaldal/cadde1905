<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('type')->default('moment')->index()->after('slug');

            $table->text('excerpt')->nullable()->after('description');
            $table->longText('content')->nullable()->after('excerpt');

            $table->date('event_date')->nullable()->after('year');
            $table->date('start_date')->nullable()->after('event_date');
            $table->date('end_date')->nullable()->after('start_date');

            $table->boolean('is_on_this_day')->default(true)->index()->after('source_url');
            $table->unsignedTinyInteger('on_this_day_month')->nullable()->index()->after('is_on_this_day');
            $table->unsignedTinyInteger('on_this_day_day')->nullable()->index()->after('on_this_day_month');

            $table->boolean('is_published')->default(true)->index()->after('on_this_day_day');
            $table->timestamp('published_at')->nullable()->after('is_published');

            $table->integer('importance_score')->default(0)->after('published_at');
            $table->boolean('is_featured')->default(false)->after('importance_score');

            $table->boolean('is_canonical')->default(true)->index()->after('is_featured');
            $table->string('canonical_key')->nullable()->index()->after('is_canonical');

            $table->index('event_date');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('published_at');
        });

        DB::statement("
            UPDATE history_events
            SET excerpt = description
            WHERE excerpt IS NULL
              AND description IS NOT NULL
        ");

        DB::statement("
            UPDATE history_events
            SET on_this_day_month = month,
                on_this_day_day = day
            WHERE on_this_day_month IS NULL
              AND on_this_day_day IS NULL
        ");

        DB::statement("
            UPDATE history_events
            SET slug = CONCAT('history-event-', id)
            WHERE slug IS NULL
        ");

        DB::statement("
            UPDATE history_events
            SET event_date = STR_TO_DATE(CONCAT(year, '-', month, '-', day), '%Y-%c-%e')
            WHERE event_date IS NULL
              AND year IS NOT NULL
        ");
    }

    public function down(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->dropUnique(['slug']);

            $table->dropIndex(['type']);
            $table->dropIndex(['is_on_this_day']);
            $table->dropIndex(['on_this_day_month']);
            $table->dropIndex(['on_this_day_day']);
            $table->dropIndex(['is_published']);
            $table->dropIndex(['is_canonical']);
            $table->dropIndex(['canonical_key']);
            $table->dropIndex(['event_date']);
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
            $table->dropIndex(['published_at']);

            $table->dropColumn([
                'slug',
                'type',
                'excerpt',
                'content',
                'event_date',
                'start_date',
                'end_date',
                'is_on_this_day',
                'on_this_day_month',
                'on_this_day_day',
                'is_published',
                'published_at',
                'importance_score',
                'is_featured',
                'is_canonical',
                'canonical_key',
            ]);
        });
    }
};