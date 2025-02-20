<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Badges\CreateBadges;
use App\Http\Controllers\API\V1\Badges\UpdateBadges;
use App\Http\Controllers\API\V1\Badges\DeleteBadges;
use App\Http\Controllers\API\V1\Badges\GetBadgesById;
use App\Http\Controllers\API\V1\Challenges\CreateChallenges;
use App\Http\Controllers\API\V1\Challenges\UpdateChallenges;
use App\Http\Controllers\API\V1\Challenges\DeleteChallenges;
use App\Http\Controllers\API\V1\Challenges\GetChallengesById;
use App\Http\Controllers\API\V1\ContactUs\CreateContactUs;
use App\Http\Controllers\API\V1\ContactUs\UpdateContactUs;
use App\Http\Controllers\API\V1\ContactUs\DeleteContactUs;
use App\Http\Controllers\API\V1\ContactUs\GetContactUsById;
use App\Http\Controllers\API\V1\Countries\CreateCountries;
use App\Http\Controllers\API\V1\Countries\UpdateCountries;
use App\Http\Controllers\API\V1\Countries\DeleteCountries;
use App\Http\Controllers\API\V1\Countries\GetCountriesById;
use App\Http\Controllers\API\V1\Faqs\CreateFaqs;
use App\Http\Controllers\API\V1\Faqs\UpdateFaqs;
use App\Http\Controllers\API\V1\Faqs\DeleteFaqs;
use App\Http\Controllers\API\V1\Faqs\GetFaqsById;
use App\Http\Controllers\API\V1\Favorites\CreateFavorites;
use App\Http\Controllers\API\V1\Favorites\UpdateFavorites;
use App\Http\Controllers\API\V1\Favorites\DeleteFavorites;
use App\Http\Controllers\API\V1\Favorites\GetFavoritesById;
use App\Http\Controllers\API\V1\Invitations\CreateInvitations;
use App\Http\Controllers\API\V1\Invitations\UpdateInvitations;
use App\Http\Controllers\API\V1\Invitations\DeleteInvitations;
use App\Http\Controllers\API\V1\Invitations\GetInvitationsById;
use App\Http\Controllers\API\V1\Levels\CreateLevels;
use App\Http\Controllers\API\V1\Levels\UpdateLevels;
use App\Http\Controllers\API\V1\Levels\DeleteLevels;
use App\Http\Controllers\API\V1\Levels\GetLevelsById;
use App\Http\Controllers\API\V1\MarketMostVolatile\CreateMarketMostVolatile;
use App\Http\Controllers\API\V1\MarketMostVolatile\UpdateMarketMostVolatile;
use App\Http\Controllers\API\V1\MarketMostVolatile\DeleteMarketMostVolatile;
use App\Http\Controllers\API\V1\MarketMostVolatile\GetMarketMostVolatileById;
use App\Http\Controllers\API\V1\MarketMoversActive\CreateMarketMoversActive;
use App\Http\Controllers\API\V1\MarketMoversActive\UpdateMarketMoversActive;
use App\Http\Controllers\API\V1\MarketMoversActive\DeleteMarketMoversActive;
use App\Http\Controllers\API\V1\MarketMoversActive\GetMarketMoversActiveById;
use App\Http\Controllers\API\V1\MarketMoversGainers\CreateMarketMoversGainers;
use App\Http\Controllers\API\V1\MarketMoversGainers\UpdateMarketMoversGainers;
use App\Http\Controllers\API\V1\MarketMoversGainers\DeleteMarketMoversGainers;
use App\Http\Controllers\API\V1\MarketMoversGainers\GetMarketMoversGainersById;

Route::prefix('v1')->group(function () {
    Route::prefix('badges')->group(function () {
        Route::post('', CreateBadges::class);
        Route::put('{id}', UpdateBadges::class);
        Route::delete('{id}', DeleteBadges::class);
        Route::get('{id}', GetBadgesById::class);
    });

    Route::prefix('challenges')->group(function () {
        Route::post('', CreateChallenges::class);
        Route::put('{id}', UpdateChallenges::class);
        Route::delete('{id}', DeleteChallenges::class);
        Route::get('{id}', GetChallengesById::class);
    });

    Route::prefix('contactus')->group(function () {
        Route::post('', CreateContactUs::class);
        Route::put('{id}', UpdateContactUs::class);
        Route::delete('{id}', DeleteContactUs::class);
        Route::get('{id}', GetContactUsById::class);
    });

    Route::prefix('countries')->group(function () {
        Route::post('', CreateCountries::class);
        Route::put('{id}', UpdateCountries::class);
        Route::delete('{id}', DeleteCountries::class);
        Route::get('{id}', GetCountriesById::class);
    });

    Route::prefix('faqs')->group(function () {
        Route::post('', CreateFaqs::class);
        Route::put('{id}', UpdateFaqs::class);
        Route::delete('{id}', DeleteFaqs::class);
        Route::get('{id}', GetFaqsById::class);
    });

    Route::prefix('favorites')->group(function () {
        Route::post('', CreateFavorites::class);
        Route::put('{id}', UpdateFavorites::class);
        Route::delete('{id}', DeleteFavorites::class);
        Route::get('{id}', GetFavoritesById::class);
    });

    Route::prefix('invitations')->group(function () {
        Route::post('', CreateInvitations::class);
        Route::put('{id}', UpdateInvitations::class);
        Route::delete('{id}', DeleteInvitations::class);
        Route::get('{id}', GetInvitationsById::class);
    });

    Route::prefix('levels')->group(function () {
        Route::post('', CreateLevels::class);
        Route::put('{id}', UpdateLevels::class);
        Route::delete('{id}', DeleteLevels::class);
        Route::get('{id}', GetLevelsById::class);
    });

    Route::prefix('marketmostvolatile')->group(function () {
        Route::post('', CreateMarketMostVolatile::class);
        Route::put('{id}', UpdateMarketMostVolatile::class);
        Route::delete('{id}', DeleteMarketMostVolatile::class);
        Route::get('{id}', GetMarketMostVolatileById::class);
    });

    Route::prefix('marketmoversactive')->group(function () {
        Route::post('', CreateMarketMoversActive::class);
        Route::put('{id}', UpdateMarketMoversActive::class);
        Route::delete('{id}', DeleteMarketMoversActive::class);
        Route::get('{id}', GetMarketMoversActiveById::class);
    });

    Route::prefix('marketmoversgainers')->group(function () {
        Route::post('', CreateMarketMoversGainers::class);
        Route::put('{id}', UpdateMarketMoversGainers::class);
        Route::delete('{id}', DeleteMarketMoversGainers::class);
        Route::get('{id}', GetMarketMoversGainersById::class);
    });
});
