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
        Schema::create('trading_simulation_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('market_id');
            $table->jsonb('symbols');
            $table->jsonb('sectors');
            $table->decimal('investment_amount', 18);
            $table->string('risk_level', 20);
            $table->string('duration', 20);
            $table->string('strategy', 50);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->decimal('expected_return_percentage', 18)->nullable()->default(0);
            $table->decimal('stop_loss_percentage', 18)->nullable()->default(0);
            $table->string('status', 20)->nullable()->default('pending');
            $table->string('selected_type', 10);
            $table->jsonb('results')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_simulation_requests');
    }
};
