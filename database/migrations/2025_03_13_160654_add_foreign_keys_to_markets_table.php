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
        Schema::table('markets', function (Blueprint $table) {
            $table->foreign(['country_id'], 'markets_country_id_fkey')->references(['id'])->on('countries')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['symbol_id'], 'markets_symbol_id_fkey')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('markets', function (Blueprint $table) {
            $table->dropForeign('markets_country_id_fkey');
            $table->dropForeign('markets_symbol_id_fkey');
        });
    }
};
