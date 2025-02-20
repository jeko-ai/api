<?php

use App\Http\Controllers\API\V1\Static\V1\Static\GetCountriesAction;
use App\Http\Controllers\API\V1\Static\V1\Static\GetIndicesAction;
use App\Http\Controllers\API\V1\Static\V1\Static\GetMarketsAction;
use App\Http\Controllers\API\V1\Static\V1\Static\GetSymbolsAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('static')->middleware('cacheResponse')->group(function () {
        Route::get('countries', GetCountriesAction::class);
        Route::get('markets', GetMarketsAction::class);
        Route::get('symbols', GetSymbolsAction::class);
        Route::get('indices', GetIndicesAction::class);
    });
});
