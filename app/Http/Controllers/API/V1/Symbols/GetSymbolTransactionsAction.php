<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\PortfolioTransaction;
use Illuminate\Http\JsonResponse;

class GetSymbolTransactionsAction
{
    public function __invoke(string $symbol): JsonResponse
    {
        // Get transactions for the symbol
        $transactions = PortfolioTransaction::where('symbol_id', $symbol)
            ->orderByDesc('executed_at')
            ->get();

        return response()->json($transactions);
    }
}
