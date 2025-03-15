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
        Schema::table('subscription_feature_usage', function (Blueprint $table) {
            $table->foreign(['subscription_feature_id'], 'subscription_feature_usage_subscription_feature_id_fkey')->references(['id'])->on('subscription_features')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['subscription_id'], 'subscription_feature_usage_subscription_id_fkey')->references(['id'])->on('subscriptions')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'subscription_feature_usage_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_feature_usage', function (Blueprint $table) {
            $table->dropForeign('subscription_feature_usage_subscription_feature_id_fkey');
            $table->dropForeign('subscription_feature_usage_subscription_id_fkey');
            $table->dropForeign('subscription_feature_usage_user_id_fkey');
        });
    }
};
