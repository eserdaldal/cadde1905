<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historical_matches', function (Blueprint $table) {

            $table->id();

            // temel kimlik
            $table->string('title', 220);
            $table->string('slug')->unique();

            // yayın
            $table->boolean('is_published')->default(true)->index();
            $table->timestamp('published_at')->nullable()->index();

            // maç bilgisi
            $table->date('match_date')->nullable()->index();
            $table->string('opponent',255)->nullable()->index();
            $table->string('competition',255)->nullable()->index();

            $table->unsignedSmallInteger('score_for')->nullable();
            $table->unsignedSmallInteger('score_against')->nullable();

            $table->string('result',20)->nullable()->index();

            // içerik
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();

            // medya
            $table->string('cover_image_path')->nullable();

            // editoryal
            $table->unsignedInteger('importance_score')->default(0)->index();
            $table->boolean('is_featured')->default(false)->index();

            // sahiplik
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index();

            $table->timestamps();

            $table->index(
                ['competition','match_date'],
                'historical_matches_competition_match_date_index'
            );

            $table->index(
                ['opponent','match_date'],
                'historical_matches_opponent_match_date_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historical_matches');
    }
};
