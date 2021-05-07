<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::prefix('admin')->namespace('Admin')->group(function(){
        Route::resource('categories', 'CategoryController', ['except' => ['show']]);
        Route::resource('products', 'ProductController',  ['except' => ['show']]);
        Route::resource('orders', 'OrderController', ['except' => ['create', 'store']]);
        Route::resource('banners', 'BannerController', ['except' => ['show']]);
        Route::resource('actions', 'ActionController', ['except' => ['show']]);
//        Route::post('/remove-product-from-order/{order_id}/{product_id}',
//            'OrderedProductController@removeProductFromOrder')->name('remove-product-from-order');
    });

