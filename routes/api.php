<?php

use App\Http\Controllers\API\V1\AI\Prediction\CreatePredictionAction;
use App\Http\Controllers\API\V1\AI\Prediction\GetPredictionsAction;
use App\Http\Controllers\API\V1\AI\Prediction\GetSymbolPredictionAction;
use App\Http\Controllers\API\V1\AI\Simulation\CreateSimulationAction;
use App\Http\Controllers\API\V1\AI\Simulation\GetSimulationsAction;
use App\Http\Controllers\API\V1\GetSymbolPriceAction;
use App\Http\Controllers\API\V1\GetSymbolQuoteAction;
use App\Http\Controllers\API\V1\News\GetNewsAction;
use App\Http\Controllers\API\V1\News\GetNewsBySentiment;
use App\Http\Controllers\API\V1\Recommendations\GetRecommendationsAction;
use App\Http\Controllers\API\V1\Recommendations\GetRecommendationsByTimeframeAction;
use App\Http\Controllers\API\V1\Static\GetBestAction;
use App\Http\Controllers\API\V1\Static\GetCompaniesAction;
use App\Http\Controllers\API\V1\Static\GetCountriesAction;
use App\Http\Controllers\API\V1\Static\GetHighestVolumeAction;
use App\Http\Controllers\API\V1\Static\GetIndicesAction;
use App\Http\Controllers\API\V1\Static\GetLastPredictionsAction;
use App\Http\Controllers\API\V1\Static\GetMarketsAction;
use App\Http\Controllers\API\V1\Static\GetMostVolatileAction;
use App\Http\Controllers\API\V1\Static\GetPlansAction;
use App\Http\Controllers\API\V1\Static\GetSectorsAction;
use App\Http\Controllers\API\V1\Static\GetSymbolsAction;
use App\Http\Controllers\API\V1\Static\GetWorstAction;
use App\Http\Controllers\API\V1\Symbols\CheckIfUserOwnSymbolAction;
use App\Http\Controllers\API\V1\Symbols\CreateSymbolAlertAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolAlertsAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolChartInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolHistoryAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolTechnicalAction;
use App\Http\Controllers\API\V1\UpdateUserSettingsAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('static')->group(function () {
        Route::middleware('cacheResponse:3600')->group(function () {
            Route::get('countries', GetCountriesAction::class);
            Route::get('markets', GetMarketsAction::class);
            Route::get('sectors', GetSectorsAction::class);
            Route::get('symbols', GetSymbolsAction::class);
            Route::get('indices', GetIndicesAction::class);
            Route::get('plans', GetPlansAction::class);
            Route::get('predictions', GetLastPredictionsAction::class);
        });
        Route::prefix('{market}')->group(function () {
            Route::get('best', GetBestAction::class);
            Route::get('companies', GetCompaniesAction::class);
            Route::get('most-volatile', GetMostVolatileAction::class);
            Route::get('highest-volume', GetHighestVolumeAction::class);
            Route::get('worst', GetWorstAction::class);
        })->middleware('cacheResponse:1440');
    });

    Route::get('prices/{id}', GetSymbolPriceAction::class)->middleware('cacheResponse:300');
    Route::get('quotes/{id}', GetSymbolQuoteAction::class)->middleware('cacheResponse:300');


    Route::prefix('recommendations')->group(function () {
        Route::get('', GetRecommendationsAction::class);

        Route::get('{timeframe}', GetRecommendationsByTimeframeAction::class)
            ->where('timeframe', 'month|quarter|biannual|year')->middleware('cacheResponse:1728000');
    });

    Route::prefix('news')->group(function () {
        Route::get('', GetNewsAction::class);
        Route::get('{sentiment}', GetNewsBySentiment::class)
            ->where('sentiment', 'negative|positive|neutral')->middleware('cacheResponse:3600');
    });


    Route::prefix('symbols')->group(function () {
        Route::prefix('{symbol}')->group(function () {
            Route::get('prediction', GetSymbolPredictionAction::class);
            Route::get('technical/{timeframe}', GetSymbolTechnicalAction::class)
                ->where('timeframe', '5m|15m|30m|1h|5h|1d|1w|1mo');
            Route::get('check', CheckIfUserOwnSymbolAction::class)->middleware('supabase.auth');
            Route::get('alerts', GetSymbolAlertsAction::class)->middleware('supabase.auth');
            Route::post('alerts', CreateSymbolAlertAction::class)->middleware('supabase.auth');


            Route::get('chart-info', GetSymbolChartInfoAction::class);
            Route::get('history', GetSymbolHistoryAction::class);


            Route::get('info', GetSymbolInfoAction::class);

        });
    });

    Route::middleware('supabase.auth')->group(function () {
        Route::post('settings', UpdateUserSettingsAction::class);
        Route::prefix('ai')->group(function () {
            Route::prefix('predictions')->group(function () {
                Route::get('', GetPredictionsAction::class);
                Route::post('', CreatePredictionAction::class);
            });
            Route::prefix('simulations')->group(function () {
                Route::get('', GetSimulationsAction::class);
                Route::post('{id}', CreateSimulationAction::class);
            });
        });
    });
});
