<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\ExController;

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

Route::apiResource('actions',ExController::class);
//Route::('actions',App\Http\Controllers\API\EController::class);

//Route::get('/',function (){
////   dump(DB::select('select * from `action_products`'));
//    $arr=\App\Models\Action::find(2);
//    dump($arr->products);
////    dump(DB::select('select * from `action_products` where `action_id`=2'));
//});
