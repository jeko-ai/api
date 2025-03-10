<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\UserSymbolAlert;

class GetSymbolAlertsAction
{
    public function __invoke(string $symbol)
    {
        $alerts = UserSymbolAlert::where([
            'symbol_id' => $symbol,
            'user_id' => request()->attributes->get('user_id'),
        ])->get();

        return response()->json($alerts);
    }
}
