<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portfolio_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('portfolio_id');
            $table->uuid('user_id');
            $table->uuid('symbol_id');
            $table->decimal('quantity', 20, 4)->default(0);
            $table->decimal('avg_buy_price', 20, 4)->default(0);
            $table->decimal('total_value', 20, 4)->nullable()->storedAs('(quantity * avg_buy_price)');
            $table->timestamp('buy_date');
            $table->timestamps();
            $table->decimal('current_price')->nullable()->default(0);
            $table->decimal('profit_loss')->nullable()->storedAs('((current_price - avg_buy_price) * quantity)');
            $table->decimal('dividends_received')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_assets');
    }
};
