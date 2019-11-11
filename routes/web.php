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

Route::get('/hosts', 'HostController@index');
Route::post('/hosts', 'HostController@create');
// Route::patch('/hosts/{id}', 'HostController@update');
Route::delete('/hosts/{host}', 'HostController@delete');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
