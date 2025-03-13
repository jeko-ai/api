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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('symbol_id');
            $table->uuid('market_id');
            $table->uuid('country_id');
            $table->uuid('sector_id');
            $table->decimal('current_price', 12);
            $table->decimal('target_price', 12);
            $table->text('reason')->nullable();
            $table->text('reason_ar')->nullable();
            $table->text('recent_performance')->nullable();
            $table->text('recent_performance_ar')->nullable();
            $table->text('competitive_positioning')->nullable();
            $table->text('competitive_positioning_ar')->nullable();
            $table->text('economic_factors')->nullable();
            $table->text('economic_factors_ar')->nullable();
            $table->string('risk_level', 10);
            $table->decimal('potential_growth', 5);
            $table->decimal('confidence_score', 5)->nullable();
            $table->decimal('expected_return', 5)->nullable();
            $table->string('recommendation_type', 10);
            $table->text('analysis_summary')->nullable();
            $table->text('analysis_summary_ar')->nullable();
            $table->timestamps();
            $table->timestamp('valid_until')->nullable();
            $table->string('timeframe');
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('short_description')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->jsonb('points')->nullable();
            $table->jsonb('points_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->jsonb('meta_tags')->nullable();
            $table->jsonb('meta_tags_ar')->nullable();
            $table->string('slug')->nullable()->unique('recommendations_slug_key');

            $table->index(['market_id', 'created_at'], 'idx_recommendations_market_created');
            $table->index(['symbol_id', 'created_at'], 'idx_recommendations_symbol_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
