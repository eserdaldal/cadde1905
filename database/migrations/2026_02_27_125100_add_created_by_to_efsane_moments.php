docker compose exec -T app sh -lc 'tee database/migrations/PUT_FILENAME_HERE.php >/dev/null << "EOF"
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("efsane_moments", function (Blueprint $table) {
            if (! Schema::hasColumn("efsane_moments", "created_by")) {
                $table->unsignedBigInteger("created_by")->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table("efsane_moments", function (Blueprint $table) {
            if (Schema::hasColumn("efsane_moments", "created_by")) {
                $table->dropColumn("created_by");
            }
        });
    }
};