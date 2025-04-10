<?php

use App\Http\Controllers\API\V1\AI\Prediction\CreatePredictionAction;
use App\Http\Controllers\API\V1\AI\Prediction\GetPredictionAction;
use App\Http\Controllers\API\V1\AI\Prediction\GetPredictionsAction;
use App\Http\Controllers\API\V1\AI\Prediction\GetSymbolPredictionAction;
use App\Http\Controllers\API\V1\AI\Simulation\CreateSimulationAction;
use App\Http\Controllers\API\V1\AI\Simulation\GetSimulationAction;
use App\Http\Controllers\API\V1\AI\Simulation\GetSimulationsAction;
use App\Http\Controllers\API\V1\Auth\GetInvitationsAction;
use App\Http\Controllers\API\V1\Auth\GetNotificationsAction;
use App\Http\Controllers\API\V1\Auth\GetUserAction;
use App\Http\Controllers\API\V1\Auth\LoginAction;
use App\Http\Controllers\API\V1\Auth\LogoutAction;
use App\Http\Controllers\API\V1\Auth\SubscribeAction;
use App\Http\Controllers\API\V1\Auth\UpdateUserSettingsAction;
use App\Http\Controllers\API\V1\Auth\VerifyAction;
use App\Http\Controllers\API\V1\News\GetNewsAction;
use App\Http\Controllers\API\V1\News\GetNewsBySentiment;
use App\Http\Controllers\API\V1\News\GetNewsDetailsAction;
use App\Http\Controllers\API\V1\Portfolio\GetPortfolioChangePercentage;
use App\Http\Controllers\API\V1\Portfolio\GetPortfolioNewsAction;
use App\Http\Controllers\API\V1\Portfolio\GetPortfolioRecommendationsAction;
use App\Http\Controllers\API\V1\Portfolio\GetUserPortfolioAction;
use App\Http\Controllers\API\V1\Portfolio\GetUserPortfolioAssetsAction;
use App\Http\Controllers\API\V1\Portfolio\GetUserPortfolioTransactionsAction;
use App\Http\Controllers\API\V1\Pricing\GetPricesAction;
use App\Http\Controllers\API\V1\Pricing\GetQuotesAction;
use App\Http\Controllers\API\V1\Pricing\GetSymbolPriceAction;
use App\Http\Controllers\API\V1\Pricing\GetSymbolQuoteAction;
use App\Http\Controllers\API\V1\Recommendations\GetRecommendationsAction;
use App\Http\Controllers\API\V1\Recommendations\GetRecommendationsByTimeframeAction;
use App\Http\Controllers\API\V1\Recommendations\GetRecommendationsDetailsAction;
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
use App\Http\Controllers\API\V1\Symbols\AddSymbolToPortfolioAction;
use App\Http\Controllers\API\V1\Symbols\BuySymbolAction;
use App\Http\Controllers\API\V1\Symbols\CheckIfUserOwnSymbolAction;
use App\Http\Controllers\API\V1\Symbols\CreateSymbolAlertAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolAlertsAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolChartInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolHistoryAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolInfoAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolNewsAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolPricesAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolRecommendationsAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolTechnicalAction;
use App\Http\Controllers\API\V1\Symbols\GetSymbolTransactionsAction;
use App\Http\Controllers\API\V1\Symbols\SellSymbolAction;
use App\Http\Controllers\Webhook\Fawaterk\CancellationAction;
use App\Http\Controllers\Webhook\Fawaterk\FailedAction;
use App\Http\Controllers\Webhook\Fawaterk\PaidAction;
use App\Http\Controllers\Webhook\Fawaterk\RefundAction;
use App\Http\Controllers\Webhook\Fawaterk\TokenizationAction;
use App\Http\Controllers\Webhook\Notifications\AI\HandelPredictionsAction;
use App\Http\Controllers\Webhook\Notifications\AI\HandelSimulationsAction;
use App\Http\Controllers\Webhook\Notifications\HandelNewsAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginAction::class)->middleware(['throttle:5,1']);
        Route::post('verify', VerifyAction::class);
        Route::middleware('auth:api')->group(function () {
            Route::post('logout', LogoutAction::class);
            Route::get('me', GetUserAction::class);
            Route::post('settings', UpdateUserSettingsAction::class);
            Route::post('subscribe', SubscribeAction::class);
            Route::get('invitations', GetInvitationsAction::class);
            Route::get('notifications', GetNotificationsAction::class);
        });
    });
    Route::prefix('static')->group(function () {
        Route::middleware('cacheResponse:3600')->group(function () {
            Route::get('countries', GetCountriesAction::class);
            Route::get('markets', GetMarketsAction::class);
            Route::get('sectors', GetSectorsAction::class);
            Route::get('symbols', GetSymbolsAction::class);
            Route::get('indices', GetIndicesAction::class);
            Route::get('predictions', GetLastPredictionsAction::class);
        });
        Route::get('plans', GetPlansAction::class);

        Route::prefix('{market}')->group(function () {
            Route::get('best', GetBestAction::class);
            Route::get('companies', GetCompaniesAction::class);
            Route::get('most-volatile', GetMostVolatileAction::class);
            Route::get('highest-volume', GetHighestVolumeAction::class);
            Route::get('worst', GetWorstAction::class);
        })->middleware('cacheResponse:1440');
    });

    Route::group([], function () {
        Route::prefix('quotes')->group(function () {
            Route::get('', GetQuotesAction::class);
            Route::get('{id}', GetSymbolQuoteAction::class);
        });
        Route::prefix('prices')->group(function () {
            Route::get('', GetPricesAction::class);
            Route::get('{id}', GetSymbolPriceAction::class);
        });
    });


    Route::prefix('recommendations')->group(function () {
        Route::get('details/{slug}', GetRecommendationsDetailsAction::class);
        Route::get('', GetRecommendationsAction::class);

        Route::get('{timeframe}', GetRecommendationsByTimeframeAction::class)
            ->where('timeframe', 'month|quarter|biannual|year')->middleware('cacheResponse:1728000');
    });

    Route::prefix('news')->group(function () {
        Route::get('details/{slug}', GetNewsDetailsAction::class);
        Route::get('', GetNewsAction::class);
        Route::get('{sentiment}', GetNewsBySentiment::class)
            ->where('sentiment', 'negative|positive|neutral')->middleware('cacheResponse:3600');
    });


    Route::prefix('symbols')->group(function () {
        Route::prefix('{symbol}')->group(function () {
            Route::get('prediction', GetSymbolPredictionAction::class);
            Route::get('technical/{timeframe}', GetSymbolTechnicalAction::class)
                ->where('timeframe', '5m|15m|30m|1h|5h|1d|1w|1mo');

            Route::get('news/{sentiment}', GetSymbolNewsAction::class)
                ->where('sentiment', 'negative|positive|neutral')->middleware('cacheResponse:3600');

            Route::get('recommendations/{timeframe}', GetSymbolRecommendationsAction::class)->where('timeframe', 'month|quarter|biannual|year');


            Route::middleware('auth:api')->group(function () {
                Route::get('check', CheckIfUserOwnSymbolAction::class);
                Route::get('alerts', GetSymbolAlertsAction::class);
                Route::post('alerts', CreateSymbolAlertAction::class);
                Route::post('add', AddSymbolToPortfolioAction::class);
                Route::post('sell', SellSymbolAction::class);
                Route::post('buy', BuySymbolAction::class);
                Route::get('transactions', GetSymbolTransactionsAction::class);
                Route::get('{from}/{to}', GetSymbolPricesAction::class);
            });


            Route::get('chart-info', GetSymbolChartInfoAction::class);
            Route::get('history', GetSymbolHistoryAction::class);


            Route::get('info', GetSymbolInfoAction::class);

        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('portfolio')->group(function () {
            Route::get('', GetUserPortfolioAction::class);
            Route::get('news/{sentiment}', GetPortfolioNewsAction::class)
                ->where('sentiment', 'negative|positive|neutral')->middleware('cacheResponse:3600');

            Route::get('recommendations/{timeframe}', GetPortfolioRecommendationsAction::class)->where('timeframe', 'month|quarter|biannual|year');

            Route::get('assets', GetUserPortfolioAssetsAction::class);
            Route::get('transactions', GetUserPortfolioTransactionsAction::class);
            Route::get('change-percentage', GetPortfolioChangePercentage::class);
        });
        Route::prefix('ai')->group(function () {
            Route::prefix('predictions')->group(function () {
                Route::get('{id}', GetPredictionAction::class);
                Route::get('', GetPredictionsAction::class);
                Route::post('', CreatePredictionAction::class);
            });
            Route::prefix('simulations')->group(function () {
                Route::get('{id}', GetSimulationAction::class);
                Route::get('', GetSimulationsAction::class);
                Route::post('', CreateSimulationAction::class);
            });
        });
    });
});

Route::prefix('webhook')->group(function () {
    Route::prefix('fawaterk')->group(function () {
        Route::get('paid', PaidAction::class);
        Route::get('tokenization', TokenizationAction::class);
        Route::get('cancellation', CancellationAction::class);
        Route::get('failed', FailedAction::class);
        Route::get('refund', RefundAction::class);
    });

    Route::prefix('notifications')->group(function () {
        Route::post('news/{id}', HandelNewsAction::class);
        Route::post('predictions/{id}/{type}', HandelPredictionsAction::class)->where('type', 'update|partially_completed|completed|failed|new');
        Route::post('simulations/{id}/{type}', HandelSimulationsAction::class)->where('type', 'update|partially_completed|completed|failed|new');
    });
});
