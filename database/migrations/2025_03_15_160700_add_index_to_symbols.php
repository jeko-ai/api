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
        Schema::table('symbols', function (Blueprint $table) {
            $table->index('next_month_recommendation');
            $table->index('next_quarter_recommendation');
            $table->index('next_biannual_recommendation');
            $table->index('next_year_recommendation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->dropIndex(['next_month_recommendation']);
            $table->dropIndex(['next_quarter_recommendation']);
            $table->dropIndex(['next_biannual_recommendation']);
            $table->dropIndex(['next_year_recommendation']);
        });
    }
};
