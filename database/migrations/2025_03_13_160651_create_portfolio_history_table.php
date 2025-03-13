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
        Schema::create('portfolio_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('portfolio_id')->nullable();
            $table->date('date');
            $table->decimal('total_value', 8, 2)->nullable()->default(0);
            $table->timestamps();
            $table->uuid('user_id');
            $table->decimal('change_percentage', 8, 2)->default(0);

            $table->unique(['portfolio_id', 'date'], 'portfolio_history_portfolio_id_date_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_history');
    }
};
