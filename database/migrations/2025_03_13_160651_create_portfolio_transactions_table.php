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
        Schema::create('portfolio_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('portfolio_id')->nullable();
            $table->uuid('symbol_id')->nullable();
            $table->decimal('quantity');
            $table->decimal('price_per_unit');
            $table->text('transaction_type')->nullable();
            $table->timestamp('executed_at')->nullable()->default(DB::raw("now()"));
            $table->uuid('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_transactions');
    }
};
