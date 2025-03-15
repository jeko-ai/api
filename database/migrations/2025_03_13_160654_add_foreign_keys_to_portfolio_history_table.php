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
        Schema::table('portfolio_history', function (Blueprint $table) {
            $table->foreign(['portfolio_id'], 'portfolio_history_portfolio_id_fkey')->references(['id'])->on('portfolios')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'portfolio_history_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_history', function (Blueprint $table) {
            $table->dropForeign('portfolio_history_portfolio_id_fkey');
            $table->dropForeign('portfolio_history_user_id_fkey');
        });
    }
};
