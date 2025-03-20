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
        Schema::create('market_movers_active', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('symbol_id');
            $table->uuid('market_id');
            $table->string('vol_price', 50)->nullable();
            $table->string('price', 50)->nullable();
            $table->string('change_percent', 20)->nullable();
            $table->string('volume', 50)->nullable();
            $table->decimal('rel_volume', 18, 8)->nullable();
            $table->string('market_cap', 50)->nullable();
            $table->string('pe_ratio', 20)->nullable();
            $table->string('eps_dil_ttm', 20)->nullable();
            $table->string('eps_dil_growth_ttm_yoy', 20)->nullable();
            $table->string('div_yield_ttm', 20)->nullable();
            $table->string('sector', 50)->nullable();
            $table->string('analyst_rating', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_movers_active');
    }
};
