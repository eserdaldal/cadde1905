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
        if (! Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->text('description')->nullable();
                $table->string('cta_label');
                $table->string('cta_route_name');
                $table->json('cta_route_params')->nullable();
                $table->string('status')->default('active');
                $table->boolean('is_enabled')->default(true);
                $table->integer('priority')->default(100);
                $table->dateTime('starts_at')->nullable();
                $table->dateTime('ends_at')->nullable();
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
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
        if (Schema::hasTable('campaigns')) {
            Schema::drop('campaigns');
        }
    }
};
