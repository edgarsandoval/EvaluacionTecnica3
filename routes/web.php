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

Route::get('test_connection', 'HomeController@test');
Route::get('load', 'HomeController@load');
Route::get('tasks', 'TaskController@index');

Route::get('/', function () {
    return redirect('tasks');
});
