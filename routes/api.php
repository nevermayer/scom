<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClienteController;
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
//Route::get('menu','App\Http\Controllers\MenuController@index');
Route::post('register',[UsersController::class,'register']);
Route::post('login',[UsersController::class,'login']);

Route::group(['middleware'=>["auth:sanctum"]],function(){
    Route::get('usuario-profile',[UsersController::class,'userprofile']);
    Route::get('logout',[UsersController::class,'logout']);
});
// PRODUCTOS...

Route::controller(ProductosController:: class)->group(function () {
       Route::get('/productos','index');
       Route::post('/producto', 'store');
       Route::get('/producto/{id}', 'show');
       Route::put('/producto/{id}', 'update');
       Route::delete('/producto/{id}', 'destroy');
 
});
// CLIENTE

Route::controller(ClienteController:: class)->group(function () {
    Route::get('/clientes','index');
    Route::post('/cliente', 'store');
    Route::get('/cliente/{id}', 'show');
    Route::put('/cliente/{id}', 'update');
    Route::delete('/cliente/{id}', 'destroy');

});
