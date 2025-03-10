<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\PortfolioTransactions;

class GetSymbolTransactionsAction
{
    public function __invoke(string $symbol)
    {
        // Get transactions for the symbol
        $transactions = PortfolioTransactions::where('symbol_id', $symbol)
            ->orderByDesc('executed_at')
            ->get();

        return response()->json($transactions);
    }
}
