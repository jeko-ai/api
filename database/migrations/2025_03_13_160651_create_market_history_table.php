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
        Schema::create('market_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pid', 10)->index('idx_market_history_pid');
            $table->bigInteger('timestamp')->index('idx_market_history_timestamp');
            $table->decimal('open', 18, 8);
            $table->decimal('high', 18, 8);
            $table->decimal('low', 18, 8);
            $table->decimal('close', 18, 8);
            $table->string('volume', 10)->nullable()->default('n/a');
            $table->string('volume_open', 10)->nullable()->default('n/a');
            $table->string('volume_at_close', 10)->nullable()->default('n/a');
            $table->boolean('status')->nullable()->default(false)->index('idx_market_history_status');

            $table->index(['pid', 'timestamp'], 'idx_market_history_pid_timestamp');
            $table->unique(['pid', 'timestamp'], 'market_history_pid_timestamp_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_history');
    }
};
