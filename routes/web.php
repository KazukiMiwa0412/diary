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


Route::get('diaries/search','DiaryController@search')->name('diaries.search');
Route::resource('diaries', 'DiaryController');
Route::get('/', 'HomeController@index')->name('home.index');

Route::resource('pictures', 'PictureController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
