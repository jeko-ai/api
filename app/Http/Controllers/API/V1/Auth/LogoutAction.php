<?php

namespace App\Http\Controllers\API\V1\Auth;

class LogoutAction
{
    public function __invoke()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully', 'status' => true]);
    }
}
