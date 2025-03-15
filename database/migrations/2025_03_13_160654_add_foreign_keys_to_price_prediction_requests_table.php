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
        Schema::table('price_prediction_requests', function (Blueprint $table) {
            $table->foreign(['market_id'], 'price_prediction_requests_market_id_fkey')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['symbol_id'], 'price_prediction_requests_symbol_id_fkey')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'price_prediction_requests_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('price_prediction_requests', function (Blueprint $table) {
            $table->dropForeign('price_prediction_requests_market_id_fkey');
            $table->dropForeign('price_prediction_requests_symbol_id_fkey');
            $table->dropForeign('price_prediction_requests_user_id_fkey');
        });
    }
};
