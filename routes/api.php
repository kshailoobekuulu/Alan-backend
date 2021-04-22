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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('actions','API\ActionController');
Route::get('actions/{action}/orders','API\ActionController@orders');
Route::get('actions/{action}/products','API\ActionController@products');

Route::apiResource('categories', 'API\CategoryController');
Route::get('categories/{category}/products','API\CategoryController@products');

Route::apiResource('banners','API\BannerController');
Route::get('banners/{banner}/photos','API\BannerController@photos');





//*     @OA\Parameter(
//     *         name="page",
//     *         in="query",
//     *         description="The page number",
//     *         required=false,
//     *         @OA\Schema(
//     *             type="integer",
//     *         )
//     *     ),
