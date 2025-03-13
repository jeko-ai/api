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
        Schema::table('price_prediction_request_results', function (Blueprint $table) {
            $table->foreign(['request_id'], 'price_prediction_request_results_request_id_fkey')->references(['id'])->on('price_prediction_requests')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('price_prediction_request_results', function (Blueprint $table) {
            $table->dropForeign('price_prediction_request_results_request_id_fkey');
        });
    }
};
