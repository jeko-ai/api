<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\LoginRequest;
use App\Jobs\SendOtpJob;

class LoginAction
{
    public function __invoke(LoginRequest $request)
    {
        SendOtpJob::dispatch($request->identifier);

        return response()->json([
            'message' => 'OTP sent',
            'status' => true
        ]);
    }
}
