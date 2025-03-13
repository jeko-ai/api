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
        Schema::table('subscription_features', function (Blueprint $table) {
            $table->foreign(['subscription_id'], 'subscription_features_subscription_id_fkey')->references(['id'])->on('subscriptions')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_features', function (Blueprint $table) {
            $table->dropForeign('subscription_features_subscription_id_fkey');
        });
    }
};
