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

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/login',[App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);


    Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'users']);
    Route::get('/reviewes', [App\Http\Controllers\Api\UserController::class, 'getReviewes']);
    Route::get('/getUser/{id}', [App\Http\Controllers\Api\UserController::class, 'getUser']);
    Route::get('/deleteUser/{id}', [App\Http\Controllers\Api\UserController::class, 'deleteUser']);
    Route::post('/editUser/{id}', [App\Http\Controllers\Api\UserController::class, 'editUser']);
    Route::post('/assignReviewer', [App\Http\Controllers\Api\UserController::class, 'assignReviewer']);
    Route::POST('/add-reviewe', [App\Http\Controllers\Api\UserController::class, 'addReviewe']);
    Route::get('/getReview/{id}', [App\Http\Controllers\Api\UserController::class, 'getReview']);
    Route::post('/editReview/{id}', [App\Http\Controllers\Api\UserController::class, 'editReview']);
    Route::get('/deleteReview/{id}', [App\Http\Controllers\Api\UserController::class, 'deleteReview']);

});
