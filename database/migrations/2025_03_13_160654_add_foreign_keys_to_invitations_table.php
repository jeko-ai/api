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
        Schema::table('invitations', function (Blueprint $table) {
            $table->foreign(['invitee_id'], 'invitations_invitee_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['invitee_id'], 'invitations_invitee_id_fkey1')->references(['id'])->on('profiles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['inviter_id'], 'invitations_inviter_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign('invitations_invitee_id_fkey');
            $table->dropForeign('invitations_invitee_id_fkey1');
            $table->dropForeign('invitations_inviter_id_fkey');
        });
    }
};
