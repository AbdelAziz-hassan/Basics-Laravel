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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\LoginAPIController@login');
Route::post('register', 'API\RegisterAPIController@register');
Route::group(['middleware'=>['jwt.auth','admin'],'namespace'=>'API'],function(){
    Route::get('/titles','TitleAPIController@index');
    Route::post('/titles','TitleAPIController@store');
    Route::patch('/titles/{id}','TitleAPIController@update');
    Route::delete('/titles/{id}','TitleAPIController@destroy');
    Route::post('/titles/{id}/media','TitleAPIController@postSlider');
    Route::get('/titles/{id}/media','TitleAPIController@getSlider');
    Route::get('/titles/{id}/casts','TitleAPIController@getCasts');
});