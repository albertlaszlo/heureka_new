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
Route::get('/hosts/search', 'HostController@search');
Route::post('/hosts', 'HostController@create');
// Route::patch('/hosts/{id}', 'HostController@update');
Route::delete('/hosts/{host}', 'HostController@delete');

// Route::get('/hosts/{host}/free-tables', 'HostController@freeTables');

Route::post('/hosts/{host}/reserve', 'ReservationController@reserve');
Route::get('/hosts/{host}/reservations', 'ReservationController@index');
Route::get('/reservations/{reservation}', 'ReservationController@get');
Route::get('/host/{hosts}', 'HostController@get');

Route::post('/fileUpload', 'HostController@fileUpload');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
