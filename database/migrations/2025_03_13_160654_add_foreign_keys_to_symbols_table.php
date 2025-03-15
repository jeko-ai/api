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
        Schema::table('symbols', function (Blueprint $table) {
            $table->foreign(['country_id'], 'symbols_country_id_fkey')->references(['id'])->on('countries')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['market_id'], 'symbols_market_id_fkey')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['sector_id'], 'symbols_sector_id_fkey')->references(['id'])->on('sectors')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->dropForeign('symbols_country_id_fkey');
            $table->dropForeign('symbols_market_id_fkey');
            $table->dropForeign('symbols_sector_id_fkey');
        });
    }
};
