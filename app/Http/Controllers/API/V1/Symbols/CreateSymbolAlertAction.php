<?php

namespace App\Http\Controllers\API\V1\Symbols;

use Illuminate\Support\Facades\DB;

class CreateSymbolAlertAction
{
    public function __invoke(string $symbol)
    {
        $body = request()->all();
        $body['_symbol_id'] = $symbol;

        $result = DB::select('CALL upsert_user_symbol_alert(:symbol, :body)', [
            'symbol' => $symbol,
            'body' => json_encode($body),
        ]);

        if (empty($result)) {
            return response()->json(['error' => 'An error occurred'], 400);
        }

        return response()->json($result);
    }
}
