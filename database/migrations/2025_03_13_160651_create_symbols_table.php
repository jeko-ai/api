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
        Schema::create('symbols', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tv_id')->nullable();
            $table->string('symbol');
            $table->string('isin')->nullable();
            $table->string('logo_id')->nullable();
            $table->string('type');
            $table->string('currency')->nullable();
            $table->string('inv_symbol')->nullable();
            $table->string('inv_id')->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->string('full_name');
            $table->string('mb_url')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->uuid('country_id');
            $table->uuid('market_id');
            $table->uuid('sector_id')->nullable();
            $table->timestamps();
            $table->timestamp('next_month_recommendation')->nullable();
            $table->timestamp('next_quarter_recommendation')->nullable();
            $table->timestamp('next_biannual_recommendation')->nullable();
            $table->timestamp('next_year_recommendation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symbols');
    }
};
