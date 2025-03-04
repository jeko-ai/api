<?php

use App\Http\Controllers\API\V1\Static\GetCountriesAction;
use App\Http\Controllers\API\V1\Static\GetIndicesAction;
use App\Http\Controllers\API\V1\Static\GetMarketsAction;
use App\Http\Controllers\API\V1\Static\GetSectorsAction;
use App\Http\Controllers\API\V1\Static\GetSymbolsAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolHistoryAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolChartInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolTechnicalAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('static')->middleware('cacheResponse')->group(function () {
        Route::get('countries', GetCountriesAction::class);
        Route::get('markets', GetMarketsAction::class);
        Route::get('sectors', GetSectorsAction::class);
        Route::get('symbols', GetSymbolsAction::class);
        Route::get('indices', GetIndicesAction::class);
    });

    Route::prefix('symbols')->group(function () {
        Route::prefix('{symbol}')->group(function () {
            Route::get('history', GetSymbolHistoryAction::class);
            Route::get('info', GetSymbolInfoAction::class);
            Route::get('chart-info', GetSymbolChartInfoAction::class);
            Route::get('technical/{frame}', GetSymbolTechnicalAction::class)
                ->where('frame', '5m|15m|30m|1h|5h|1d|1w|1mo');
        });
    });
});
