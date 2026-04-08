<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timeline_entries', function (Blueprint $table) {
            $table->id();

            $table->date('timeline_date');
            $table->string('title');
            $table->text('excerpt')->nullable();

            $table->string('type', 50)->default('moment');
            $table->string('icon', 50)->nullable();

            $table->nullableMorphs('source');

            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('position')->default(0);

            $table->timestamps();

            $table->index(['timeline_date', 'position'], 'timeline_entries_date_position_idx');
            $table->index(['type', 'is_visible'], 'timeline_entries_type_visible_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_entries');
    }
};