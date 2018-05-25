<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('todos', 'TodoController@index');
Route::get('todo/{todo}', 'TodoController@show');
Route::post('todo', 'TodoController@store');
Route::post('todo/{todo}', 'TodoController@update')->where('todo', '[0-9]+');;
Route::delete('todo/{todo}', 'TodoController@destroy')->where('todo', '[0-9]+');;

Route::post('todo/complete/{todo}', 'TodoController@markComplete');
