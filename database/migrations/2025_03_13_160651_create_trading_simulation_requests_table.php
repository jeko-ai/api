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
            $table->enum('status', ['pending', 'in_progress', 'partially_completed', 'completed', 'failed'])->default('pending')->index('idx_trading_simulation_requests_status');
            $table->string('selected_type', 10);
            $table->jsonb('stock_selections')->nullable();
            $table->jsonb('portfolio_value_over_time')->nullable();
            $table->jsonb('final_portfolio_status')->nullable();
            $table->jsonb('performance_metrics')->nullable();
            $table->text('strategy_analysis_en')->nullable();
            $table->text('strategy_analysis_ar')->nullable();
            $table->text('expected_return_analysis_en')->nullable();
            $table->text('expected_return_analysis_ar')->nullable();
            $table->text('overall_summary_and_learnings_en')->nullable();
            $table->text('overall_summary_and_learnings_ar')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['market_id', 'strategy']);
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
