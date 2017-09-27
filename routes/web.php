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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','HomeController@index');

//路由组
Route::group(['midderware'=>'auth','namespace'=>'Admin','prefix'=>'admin'],function() {
    Route::get('/','HomeController@index');
    Route::resource('article','ArticleController');
});
