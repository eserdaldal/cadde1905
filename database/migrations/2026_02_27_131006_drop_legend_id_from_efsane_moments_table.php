<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('efsane_moments', function (Blueprint $table) {
            // Eğer foreign key varsa önce düşür.
            // Laravel default isim: efsane_moments_legend_id_foreign
            if (Schema::hasColumn('efsane_moments', 'legend_id')) {
                try {
                    $table->dropForeign(['legend_id']);
                } catch (\Throwable $e) {
                    // Bazı durumlarda FK adı farklı olabilir; migrate hata verirse aşağıda alternatif adımı veriyorum.
                }

                $table->dropColumn('legend_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('efsane_moments', function (Blueprint $table) {
            // Geri alma: legend_id kolonunu geri ekler (nullable)
            $table->foreignId('legend_id')->nullable()->constrained('legends')->nullOnDelete();
        });
    }
};