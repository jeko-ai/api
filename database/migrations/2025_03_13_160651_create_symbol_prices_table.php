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
        Schema::create('symbol_prices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('symbol_id');
            $table->string('pid');
            $table->string('last_dir')->nullable();
            $table->decimal('last_numeric')->nullable();
            $table->decimal('last')->nullable();
            $table->decimal('bid')->nullable();
            $table->decimal('ask')->nullable();
            $table->decimal('high')->nullable();
            $table->decimal('low')->nullable();
            $table->decimal('last_close')->nullable();
            $table->string('pc')->nullable();
            $table->string('pcp')->nullable();
            $table->string('pc_col')->nullable();
            $table->time('time')->nullable();
            $table->bigInteger('timestamp')->nullable();
            $table->string('turnover')->nullable();
            $table->decimal('turnover_numeric')->nullable();
            $table->timestamps();

            $table->index(['symbol_id', 'timestamp'], 'idx_symbol_prices');
            $table->index(['symbol_id', 'timestamp'], 'idx_symbol_prices_symbol_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symbol_prices');
    }
};
