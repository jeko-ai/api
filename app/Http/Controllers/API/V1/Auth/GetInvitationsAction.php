<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\Invitation;

class GetInvitationsAction
{
    public function __invoke()
    {
        $invitations = Invitation::select(['id', 'created_at', 'status', 'invitee_id', 'invitee_email', 'invitee_phone'])
            ->with('profile:id,full_name')
            ->get();

        $grouped = $invitations->groupBy('status');

        return response()->json($grouped);
    }
}
