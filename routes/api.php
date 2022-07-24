<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(ApiController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::post('/post', 'store');
    Route::get('/post/{id}', 'show');
    Route::put('/post/{id}', 'update');
    Route::delete('/post/{id}', 'destroy');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/user/{id}', 'show');
});
