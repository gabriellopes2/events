<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\UsersController;
use App\Models\SubscriptionModel;
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

Route::post('login', [UsersController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('events', [EventsController::class, 'index']);
    Route::get('events/{id}', [EventsController::class, 'searchEventParticipants']);
    Route::get('subscriptions/{id}', [SubscriptionsController::class, 'searchSubscription']);
    Route::post('subscriptions/cancel/{id}', [SubscriptionsController::class, 'cancelSubscription']);
    Route::post('subscriptions', [SubscriptionsController::class, 'register']);
    Route::post('checkin/{id}', [SubscriptionsController::class, 'checkin']);
    Route::post('users', [UsersController::class, 'index']);
});

