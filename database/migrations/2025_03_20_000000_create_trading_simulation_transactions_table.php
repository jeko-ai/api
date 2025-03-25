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
        Schema::create('trading_simulation_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('trading_simulation_request_id');
            $table->timestamp('timestamp');
            $table->string('symbol', 20);
            $table->enum('action', ['BUY', 'SELL']);
            $table->decimal('price', 18, 2);
            $table->integer('quantity');
            $table->text('reason_en')->nullable();
            $table->text('reason_ar')->nullable();
            $table->timestamps();

            $table->foreign('trading_simulation_request_id')
                ->references('id')
                ->on('trading_simulation_requests')
                ->onDelete('cascade');

            $table->index(['trading_simulation_request_id', 'timestamp']);
            $table->index(['symbol', 'action']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_simulation_transactions');
    }
};
