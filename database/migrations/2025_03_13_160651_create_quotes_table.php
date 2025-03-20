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
        Schema::create('quotes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('symbol_id')->unique('quotes_symbol_id_key');
            $table->text('symbol');
            $table->text('name');
            $table->text('exchange');
            $table->text('description');
            $table->decimal('last_price', 18, 8);
            $table->decimal('change', 18, 8);
            $table->decimal('change_percent', 18, 8);
            $table->decimal('open_price', 18, 8);
            $table->decimal('high_price', 18, 8);
            $table->decimal('low_price', 18, 8);
            $table->decimal('prev_close_price', 18, 8);
            $table->bigInteger('volume');
            $table->decimal('ask_price', 18, 8)->nullable()->default(0);
            $table->decimal('bid_price', 18, 8)->nullable()->default(0);
            $table->decimal('spread', 18, 8)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
