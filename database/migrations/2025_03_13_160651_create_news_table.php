<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->text('link');
            $table->string('resource_id')->unique('news_resource_id_key');
            $table->string('language');
            $table->string('image_url')->nullable();
            $table->string('small_image_url')->nullable();
            $table->smallInteger('score')->nullable();
            $table->text('sentiment')->nullable();
            $table->text('reason')->nullable();
            $table->jsonb('negative_aspects')->nullable();
            $table->jsonb('positive_aspects')->nullable();
            $table->uuid('symbol_id')->nullable();
            $table->uuid('market_id')->nullable();
            $table->uuid('country_id')->nullable();
            $table->timestamps();
            $table->json('images')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('date')->nullable();
            $table->uuid('sector_id')->nullable();
            $table->boolean('is_rewritten')->default(false);
            $table->string('source')->default('mb');
            $table->jsonb('actions')->nullable();
            $table->string('slug')->unique('news_slug_key');
            $table->jsonb('meta_tags')->nullable();
            $table->text('meta_description')->nullable();

            $table->index(['language', 'created_at'], 'idx_news_language_created_at');
            $table->index(['language', 'is_rewritten', 'image_url', 'created_at'], 'idx_news_language_rewritten_image_created_at');
            $table->index(['symbol_id', 'created_at'], 'idx_news_symbol_created');
            $table->index(['symbol_id', 'language', 'created_at'], 'idx_news_symbol_language_created');
            $table->unique(['resource_id', 'source'], 'unique_resource_source_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
