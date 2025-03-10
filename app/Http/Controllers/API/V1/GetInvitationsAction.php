<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Invitations;

class GetInvitationsAction
{
    public function __invoke()
    {
        $invitations = Invitations::select(['id', 'created_at', 'status', 'invitee_id', 'invitee_email', 'invitee_phone'])
            ->with('profile:full_name')
            ->get();

        $grouped = $invitations->groupBy('status');

        return response()->json($grouped);
    }
}
