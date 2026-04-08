<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('legends', function (Blueprint $table) {
            // Not: created_by zorunlu olursa eski kayıtlar kırılabilir.
            // O yüzden önce nullable başlatıyoruz.
            $table->foreignId('created_by')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('legends', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
        });
    }
};