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
        Schema::create('markets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('country_id')->nullable();
            $table->string('name_en', 100);
            $table->string('name_ar', 100);
            $table->string('code', 10)->unique('markets_symbol_key');
            $table->string('timezone', 50);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
            $table->uuid('symbol_id');
            $table->string('tv_link')->nullable();
            $table->jsonb('trading_days')->nullable();
            $table->time('open_at')->nullable();
            $table->time('close_at')->nullable();
            $table->boolean('is_open')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
