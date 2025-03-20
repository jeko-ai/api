<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_symbol_alerts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('symbol_id');
            $table->string('tv_id', 50)->nullable()->index('idx_tv_id');
            $table->decimal('price_alert', 18, 8)->nullable();
            $table->boolean('new_recommendation')->nullable()->default(false);
            $table->boolean('latest_news')->nullable()->default(false);
            $table->boolean('new_predictions')->nullable()->default(false);
            $table->boolean('unusual_volume_alert')->nullable()->default(false);
            $table->boolean('volatility_alert')->nullable()->default(false);
            $table->boolean('earnings_report_alert')->nullable()->default(false);
            $table->boolean('analyst_rating_alert')->nullable()->default(false);
            $table->boolean('corporate_events_alert')->nullable()->default(false);
            $table->boolean('market_movement_alert')->nullable()->default(false);
            $table->boolean('ai_smart_alert')->nullable()->default(false);
            $table->timestamps();

            $table->boolean('enable_price_alert')->nullable()->default(false);
            $table->string('inv_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_symbol_alerts');
    }
};
