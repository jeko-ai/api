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
        Schema::table('recommendations', function (Blueprint $table) {
            $table->foreign(['country_id'], 'recommendations_country_id_fkey')->references(['id'])->on('countries')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['market_id'], 'recommendations_market_id_fkey')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['sector_id'], 'recommendations_sector_id_fkey')->references(['id'])->on('sectors')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['symbol_id'], 'recommendations_symbol_id_fkey')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropForeign('recommendations_country_id_fkey');
            $table->dropForeign('recommendations_market_id_fkey');
            $table->dropForeign('recommendations_sector_id_fkey');
            $table->dropForeign('recommendations_symbol_id_fkey');
        });
    }
};
