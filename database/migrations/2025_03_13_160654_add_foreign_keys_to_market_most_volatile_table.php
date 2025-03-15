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
        Schema::table('market_most_volatile', function (Blueprint $table) {
            $table->foreign(['market_id'], 'market_most_volatile_market_id_fkey')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['symbol_id'], 'market_most_volatile_symbol_id_fkey')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_most_volatile', function (Blueprint $table) {
            $table->dropForeign('market_most_volatile_market_id_fkey');
            $table->dropForeign('market_most_volatile_symbol_id_fkey');
        });
    }
};
