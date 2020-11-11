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

Route::get('/orders', "OrderController@orders")->middleware('auth:api');
Route::post('/order', "OrderController@store");
Route::get('/pizzas', "PizzaController@pizzas");
Route::post('/createPizza', "PizzaController@store");
Route::post('/logout', "AuthController@logOut")->middleware('auth:api');
Route::post('/signup', "AuthController@signUp");
Route::post('/signin', "AuthController@signIn");