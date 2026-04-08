<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\News;
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

        $missing = DB::table('news_tag as nt')
            ->leftJoin('taggables as tg', function ($join) {
                $join->on('tg.tag_id', '=', 'nt.tag_id')
                    ->on('tg.taggable_id', '=', 'nt.news_id')
                    ->where('tg.taggable_type', '=', News::class);
            })
            ->whereNull('tg.tag_id')
            ->select('nt.tag_id', 'nt.news_id')
            ->get();

        if ($missing->isEmpty()) {
            return;
        }

        $now = now();
        $payload = $missing->map(function ($row) use ($now) {
            return [
                'tag_id' => $row->tag_id,
                'taggable_type' => News::class,
                'taggable_id' => $row->news_id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();

        DB::table('taggables')->insert($payload);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('news_tag') || ! Schema::hasTable('taggables')) {
            return;
        }

        DB::table('taggables')
            ->where('taggable_type', News::class)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('news_tag as nt')
                    ->whereColumn('nt.tag_id', 'taggables.tag_id')
                    ->whereColumn('nt.news_id', 'taggables.taggable_id');
            })
            ->delete();
    }
};
