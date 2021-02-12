<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\StoreController;
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

Route::get('/stores/map', [StoreController::class, 'getStoresOnMap']);
Route::get('/stores/{name}', [StoreController::class, 'getStoresByName']);
Route::get('/store/{id}', [StoreController::class, 'getStore']);
Route::get('/store/{id}/comments', [StoreController::class, 'getStoreComments']);

Route::get('/cities/{name}', [CityController::class, 'getCitiesByName']); // useless

Route::get('/categories', [CategoryController::class, 'getCategories']);
