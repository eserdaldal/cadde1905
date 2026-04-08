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
        Schema::table('world_cup_stadiums', function (Blueprint $table) {
            // Editoryal Alanlar
            if (!Schema::hasColumn('world_cup_stadiums', 'description')) {
                $table->longText('description')->nullable()->after('description_editorial');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'hero_image')) {
                $table->string('hero_image')->nullable()->after('image_override');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'seating_plan_image')) {
                $table->string('seating_plan_image')->nullable()->after('hero_image');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'gallery')) {
                $table->json('gallery')->nullable()->after('seating_plan_image');
            }
            
            // Ek Bilgiler
            if (!Schema::hasColumn('world_cup_stadiums', 'address')) {
                $table->string('address')->nullable()->after('country_api');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'opened_year')) {
                $table->integer('opened_year')->nullable()->after('capacity');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'surface_type')) {
                $table->string('surface_type')->nullable()->after('opened_year');
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'capacity_override')) {
                $table->integer('capacity_override')->nullable()->after('capacity');
            }

            // SEO Alanları
            if (!Schema::hasColumn('world_cup_stadiums', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('world_cup_stadiums', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }

            // Slug Uniqueness (Zaten varsa unique yap)
            // SQLite veya MySQL farketmeksizin uyumlu olması için try-catch veya existence kontrolü
        });

        // Slug Uniqueness Index (Ayrı bir adım olarak daha güvenli)
        try {
            Schema::table('world_cup_stadiums', function (Blueprint $table) {
                // Not: Slug unique olmalı ama tournament_id ile birleşik unique olması daha mantıklı olabilir 
                // ancak user "slug (unique)" dediği için global unique yapıyoruz.
                $table->unique('slug');
            });
        } catch (\Exception $e) {
            // Kayıtlı olabilir, logla veya geç
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('world_cup_stadiums', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'hero_image',
                'seating_plan_image',
                'gallery',
                'address',
                'opened_year',
                'surface_type',
                'capacity_override',
                'meta_title',
                'meta_description'
            ]);
            $table->dropUnique(['slug']);
        });
    }
};
