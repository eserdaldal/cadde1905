<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1) Kolonlar
            $table->string('rank', 20)->default('nev_zuhur');
            $table->unsignedInteger('cp_score')->default(0);

            $table->string('avatar_path', 255)->nullable();
            $table->dateTime('last_login_at')->nullable();

            // 2) Indexler
            $table->index('rank');
            $table->index('cp_score');
            $table->index('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            /**
             * Geri alma mantığı:
             * - up() içinde index ekledik → rollback'te önce indexleri kaldırırız
             * - sonra up() içinde eklediğimiz kolonları kaldırırız
             */

            // 1) Indexleri kaldır
            $table->dropIndex(['rank']);
            $table->dropIndex(['cp_score']);
            $table->dropIndex(['last_login_at']);

            // 2) Kolonları kaldır
            $table->dropColumn([
                'rank',
                'cp_score',
                'avatar_path',
                'last_login_at',
            ]);
        });
    }
};