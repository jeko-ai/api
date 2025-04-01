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
        Schema::create('price_prediction_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable()->index('idx_price_prediction_requests_user_id');
            $table->uuid('symbol_id')->nullable()->index('idx_price_prediction_requests_symbol_id');
            $table->string('symbol', 50);
            $table->uuid('market_id')->nullable()->index('idx_price_prediction_requests_market_id');
            $table->string('prediction_type', 20);
            $table->timestamp('prediction_start_date');
            $table->timestamp('prediction_end_date');
            $table->enum('status', ['pending', 'in_progress', 'partially_completed', 'completed', 'failed'])->default('pending')->index('idx_price_prediction_requests_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_prediction_requests');
    }
};
