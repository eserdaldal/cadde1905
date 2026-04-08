<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('slug')->unique();

            $table->smallInteger('year')->index();

            $table->date('event_date')->nullable();

            $table->string('type')->index();

            $table->text('summary')->nullable();

            $table->longText('content')->nullable();

            $table->boolean('is_active')->default(true)->index();

            $table->integer('sort_order')->default(0)->index();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};