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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    'as' => 'photos.index',
    'uses' => 'PhotoController@index',
    'middleware' => 'auth'
]);

Route::post('photos/store', [
    'as'=>'photos.store',
    'uses'=>'PhotoController@store',
    'middleware'=>'auth'
]);

Route::get('photos/delete/{id}', [
    'as' => 'photo.delete',
    'uses' => 'PhotoController@destroy',
    'middleware' => 'auth'
]);
