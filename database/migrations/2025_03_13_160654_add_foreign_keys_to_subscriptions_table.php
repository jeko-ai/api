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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreign(['plan_id'], 'subscriptions_plan_id_fkey')->references(['id'])->on('plans')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['user_id'], 'subscriptions_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign('subscriptions_plan_id_fkey');
            $table->dropForeign('subscriptions_user_id_fkey');
        });
    }
};
