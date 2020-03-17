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

Auth::routes();

Route::get('/', 'ReviewController@index')->name('index');
Route::get('/show/{id}', 'ReviewController@show')->name('show');

Route::group(['middleware' => 'auth'], function() {
  Route::get('/review', 'ReviewController@create')->name('create');
  Route::post('/review/store', 'ReviewController@store')->name('store');
  Route::get('/mypage/{id}', 'ReviewController@myPage')->name('mypage');
  Route::get('/edit/{id}', 'ReviewController@edit')->name('edit');
  Route::put('/update/{id}', 'ReviewController@update')->name('update');
  Route::delete('/destroy/{id}', 'ReviewController@destroy')->name('destroy');
});

