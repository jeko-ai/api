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
        Schema::table('user_challenges', function (Blueprint $table) {
            $table->foreign(['challenge_id'], 'user_challenges_challenge_id_fkey')->references(['id'])->on('challenges')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'user_challenges_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_challenges', function (Blueprint $table) {
            $table->dropForeign('user_challenges_challenge_id_fkey');
            $table->dropForeign('user_challenges_user_id_fkey');
        });
    }
};
