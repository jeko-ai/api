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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->char('language', 2)->default('en');
            $table->enum('risk_level', ['low', 'medium', 'high'])->nullable();
            $table->uuid('country_id')->nullable();

            $table->boolean('is_notification_enabled')->default(false);
            $table->boolean('is_price_alerts_enabled')->default(false);
            $table->boolean('is_new_recommendations_alerts_enabled')->default(false);
            $table->boolean('is_portfolio_update_alerts_enabled')->default(false);
            $table->boolean('is_market_sentiment_alerts_enabled')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
