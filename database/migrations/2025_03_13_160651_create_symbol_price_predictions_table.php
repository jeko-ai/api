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
        Schema::create('symbol_price_predictions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pid');
            $table->uuid('symbol_id');
            $table->uuid('market_id');
            $table->string('symbol', 50);
            $table->string('market', 50);
            $table->timestamp('prediction_date');
            $table->decimal('predicted_price', 18, 6);
            $table->decimal('confidence_level', 5);
            $table->string('prediction_interval', 20);
            $table->timestamps();


            $table->index(['symbol', 'prediction_date'], 'idx_symbol_prediction_date');
            $table->unique(['symbol_id', 'market_id', 'prediction_date', 'prediction_interval'], 'symbol_price_predictions_symbol_id_market_id_prediction_dat_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symbol_price_predictions');
    }
};
