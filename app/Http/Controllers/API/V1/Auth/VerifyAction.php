<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\VerifyRequest;
use App\Models\User;
use Ichtrojan\Otp\Otp;

class VerifyAction
{
    public function __invoke(VerifyRequest $request)
    {
        $validation = (new Otp)->validate($request->identifier, $request->token);

        if ($validation->status) {
            $user = User::firstOrCreate([
                'email' => $request->identifier
            ]);
            return response()->json([
                'message' => 'OTP verified',
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('auth_token')->accessToken
            ]);
        }

        return response()->json($validation, $validation->status ? 200 : 400);
    }
}
