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
        if (! Schema::hasTable('widget_overrides')) {
            Schema::create('widget_overrides', function (Blueprint $table) {
                $table->id();
                $table->string('widget_key')->unique();
                $table->boolean('is_enabled')->nullable();
                $table->integer('priority_override')->nullable();
                $table->text('notes')->nullable();
                $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('widget_overrides')) {
            Schema::drop('widget_overrides');
        }
    }
};
