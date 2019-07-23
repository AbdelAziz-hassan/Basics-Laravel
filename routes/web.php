<?php

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

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/admin', 'HomeController@admin')->name('admin');
    Route::resource('titles','TitleController');
    Route::get('titles/{id}/media','TitleController@editSlider')->name('titles.slider');
    Route::post('titles/{id}/media','TitleController@postSlider');
    Route::get('editSlider/{id}','FileController@editSlider')->name('titles.edit_slider');
    Route::post('editSlider/{id}','FileController@postSlider');
    Route::get('/getTitleFiles/{id}','FileController@getTitleFiles');
    Route::post('/deleteFile/{id}', 'FileController@deleteFile');
    Route::resource('categories','CategoryController');
    Route::resource('keywords','KeywordController');
    Route::resource('groups','GroupController');
    Route::resource('seasons','SeasonController');
    Route::get('seasons/{id}/media','SeasonController@editSlider')->name('seasons.slider');
    Route::post('seasons/{id}/media','SeasonController@postSlider');
    Route::resource('episodes','EpisodeController', [
        'except' => [ 'index' ]
    ]);
    Route::get('episodes/{id}/media','EpisodeController@editSlider')->name('episodes.slider');
    Route::post('episodes/{id}/media','EpisodeController@postSlider');
    Route::resource('persons','PersonController');
    Route::get('persons/{id}/media','PersonController@editSlider')->name('persons.slider');
    Route::post('persons/{id}/media','PersonController@postSlider');
    Route::resource('roles','RoleController');
    Route::resource('characters','CharacterController');
    Route::get('characters/{id}/media','CharacterController@editSlider')->name('characters.slider');
    Route::post('characters/{id}/media','CharacterController@postSlider');
    Route::resource('casts','CastController');
    Route::resource('users','UserController');
});
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/title/{slug}','TitleController@titleBySlug');
Route::get('/name/{slug}','PersonController@personBySlug');
Route::get('/title/{slug}/reviews','TitleController@titleReviews');
Route::get('/person/{slug}/reviews','PersonController@personReviews');
Route::get('/title/{slug}/fullcast','TitleController@fullcast');
Route::get('/chart/top','TitleController@top');
Route::get('/chart/toptv','TitleController@toptv');
Route::get('/title/{slug}/episodes','TitleController@episodes');
Route::get('/title/{slug}/episode/{e_slug}','EpisodeController@episode');
Route::get('/search/title','TitleController@search');
Route::get('/find','TitleController@find');
Route::get('/character/{slug}','CharacterController@characterBySlug');
Route::get('/character/{slug}/reviews','CharacterController@characterReviews');
Route::get('/user/{slug}','UserController@user');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/title/review','TitleController@review');
    Route::post('/title/{slug}/review','TitleController@storeReview');
    Route::post('/title/review/delete','TitleController@deleteReview');
    Route::post('/person/review','PersonController@review');
    Route::post('/person/{slug}/review','PersonController@storeReview');
    Route::post('/person/review/delete','PersonController@deleteReview');
    Route::post('/character/review','CharacterController@review');
    Route::post('/character/{slug}/review','CharacterController@storeReview');
    Route::post('/character/review/delete','CharacterController@deleteReview');
    Route::post('/episode/review','EpisodeController@review');
    Route::post('/episode/{slug}/review','EpisodeController@storeReview');
    Route::post('/episode/review/delete','EpisodeController@deleteReview');
    Route::post('/user/{id}/change','UserController@changePassword');
    Route::post('/user/{id}/update','UserController@updateUser');
    Route::post('/user/{id}/photo','UserController@updatePhoto');
    Route::get('/user/{slug}/settings','UserController@editUser');
});
