<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("history_events", function (Blueprint $table) {
            if (! Schema::hasColumn("history_events", "created_by")) {
                $table->unsignedBigInteger("created_by")->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table("history_events", function (Blueprint $table) {
            if (Schema::hasColumn("history_events", "created_by")) {
                $table->dropColumn("created_by");
            }
        });
    }
};
