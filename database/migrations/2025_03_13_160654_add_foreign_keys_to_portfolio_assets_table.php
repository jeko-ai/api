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
        Schema::table('portfolio_assets', function (Blueprint $table) {
            $table->foreign(['portfolio_id'], 'portfolio_assets_portfolio_id_fkey')->references(['id'])->on('portfolios')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['symbol_id'], 'portfolio_assets_symbol_id_fkey')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'portfolio_assets_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_assets', function (Blueprint $table) {
            $table->dropForeign('portfolio_assets_portfolio_id_fkey');
            $table->dropForeign('portfolio_assets_symbol_id_fkey');
            $table->dropForeign('portfolio_assets_user_id_fkey');
        });
    }
};
