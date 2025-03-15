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
        Schema::table('news', function (Blueprint $table) {
            $table->foreign(['country_id'], 'fk_country')->references(['id'])->on('countries')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['market_id'], 'fk_market')->references(['id'])->on('markets')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['symbol_id'], 'fk_symbol')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['sector_id'], 'j_sector_id_fkey')->references(['id'])->on('sectors')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('fk_country');
            $table->dropForeign('fk_market');
            $table->dropForeign('fk_symbol');
            $table->dropForeign('j_sector_id_fkey');
        });
    }
};
