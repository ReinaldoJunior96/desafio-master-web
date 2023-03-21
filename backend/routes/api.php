<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(PedidoController::class)->group(function(){
    Route::post('/cadastrar', 'store');
});


Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function(){
    Route::post('login','login');
    Route::post('logout', 'logout');
    Route::post('me', 'me');
});


//Route::group([
//
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//
//
//
//    Route::post('refresh', 'AuthController@refresh');
//
//
//});

Route::controller(ProdutoController::class)->group(function(){
   Route::get('all','index');
});


