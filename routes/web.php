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

Route::post('/{api_key}/insert/employee', 'APIController@insertEmployee');
Route::get('/{api_key}/employees', 'APIController@getEmployee');
Route::get('/{api_key}/report', 'APIController@getReport');
Route::get('/{api_key}/{field}', 'APIController@getField');
