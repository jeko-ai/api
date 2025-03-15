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
        Schema::table('user_symbol_alerts', function (Blueprint $table) {
            $table->foreign(['symbol_id'], 'fk_symbol_id')->references(['id'])->on('symbols')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'fk_user_id')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->unique(['symbol_id', 'user_id'], 'unique_symbol_alerts_symbol_id_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_symbol_alerts', function (Blueprint $table) {
            $table->dropForeign('fk_symbol');
            $table->dropForeign('fk_user');
            $table->dropForeign('user_symbol_alerts_symbol_id_fkey');
            $table->dropForeign('user_symbol_alerts_user_id_fkey');
        });
    }
};
