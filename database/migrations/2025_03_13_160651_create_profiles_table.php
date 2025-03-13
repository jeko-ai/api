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
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name')->default('not_set');
            $table->char('language', 2)->default('en');
            $table->string('risk_level', 10)->default('medium');
            $table->uuid('country_id')->nullable();
            $table->boolean('is_notification_enabled')->default(false);
            $table->boolean('is_price_alerts_enabled')->default(false);
            $table->boolean('is_new_recommendations_alerts_enabled')->default(false);
            $table->boolean('is_portfolio_update_alerts_enabled')->default(false);
            $table->boolean('is_market_sentiment_alerts_enabled')->default(false);
            $table->timestamps();
            $table->text('fcm_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
