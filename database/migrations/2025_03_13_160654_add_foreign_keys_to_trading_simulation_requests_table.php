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
        Schema::table('trading_simulation_requests', function (Blueprint $table) {
            $table->foreign(['market_id'], 'trading_simulation_requests_market_id_fkey')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('restrict');
            $table->foreign(['user_id'], 'trading_simulation_requests_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trading_simulation_requests', function (Blueprint $table) {
            $table->dropForeign('trading_simulation_requests_market_id_fkey');
            $table->dropForeign('trading_simulation_requests_user_id_fkey');
        });
    }
};
