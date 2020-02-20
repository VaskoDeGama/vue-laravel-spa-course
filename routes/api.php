<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('bookables', 'Api\BookableController')->only(['index', 'show']);

Route::get('bookables/{bookables}/availability', 'Api\BookableAvailabilityController')
    ->name('bookables.availibility.show');

Route::get('bookables/{bookable}/reviews', 'Api\BookableReviewController')
    ->name('bokable.reviews.index');

Route::get('bookables/{bookable}/reviews', 'Api\BookableReviewController')
    ->name('bokable.reviews.index');

Route::apiResource('reviews', 'Api\ReviewController')->only(['show']);
