<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\UserSymbolAlert;
use Illuminate\Http\JsonResponse;

class GetSymbolAlertsAction
{
    public function __invoke(string $symbol): JsonResponse
    {
        $alerts = UserSymbolAlert::where([
            'symbol_id' => $symbol,
            'user_id' => request()->user()->id,
        ])->first();

        return response()->json($alerts);
    }
}
