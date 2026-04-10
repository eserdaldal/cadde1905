<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('world_cup_stadiums', function (Blueprint $table) {
            if (! Schema::hasColumn('world_cup_stadiums', 'description')) {
                $table->longText('description')->nullable()->after('description_editorial');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'hero_image')) {
                $table->string('hero_image')->nullable()->after('image_override');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'seating_plan_image')) {
                $table->string('seating_plan_image')->nullable()->after('hero_image');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'gallery')) {
                $table->json('gallery')->nullable()->after('seating_plan_image');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'address')) {
                $table->string('address')->nullable()->after('country_api');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'opened_year')) {
                $table->integer('opened_year')->nullable()->after('capacity');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'surface_type')) {
                $table->string('surface_type')->nullable()->after('opened_year');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'capacity_override')) {
                $table->integer('capacity_override')->nullable()->after('capacity');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('gallery');
            }

            if (! Schema::hasColumn('world_cup_stadiums', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('world_cup_stadiums', function (Blueprint $table) {
            $columnsToDrop = [];

            foreach ([
                'description',
                'hero_image',
                'seating_plan_image',
                'gallery',
                'address',
                'opened_year',
                'surface_type',
                'capacity_override',
                'meta_title',
                'meta_description',
            ] as $column) {
                if (Schema::hasColumn('world_cup_stadiums', $column)) {
                    $columnsToDrop[] = $column;
                }
            }

            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
