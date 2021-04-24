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
Route::apiResource('categories', 'API\CategoryController');
Route::apiResource('banners','API\BannerController');
Route::apiResource('products','API\ProductController');
Route::apiResource('orders','API\OrderController');

//Route::post('add-to-cart', 'API\CartController@addToCart')->name('add-to-cart');
//Route::get('get-cart', 'API\CartController@getCart')->name('get-cart');



