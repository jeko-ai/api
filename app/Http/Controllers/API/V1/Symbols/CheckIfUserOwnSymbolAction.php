<?php

namespace App\Http\Controllers\API\V1\Symbols;

use Illuminate\Support\Facades\DB;

class CheckIfUserOwnSymbolAction
{
    public function __invoke($symbol)
    {
        $data = DB::selectOne('select * from does_user_own_symbol(:symbol_id)', [
            'symbol_id' => $symbol,
        ]);

        return response()->json([
            'result' => (bool)$data,
        ]);
    }
}
