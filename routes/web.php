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

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::get('/search', [
    'uses' => 'SearchController@index',
    'as' => 'search'
]);

Route::prefix('words')->name('words.')->group(function () {
    Route::get('/index', ['uses' => 'WordController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'WordController@create', 'as' => 'create']);
    Route::post('/create', ['uses' => 'WordController@store', 'as' => 'store']);

    Route::get('/grab', ['uses' => 'WordController@grab', 'as' => 'grab']);
});
