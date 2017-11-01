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
Route::get('/convert', function () {
    return view('welcome');
});

Route::post('/convert', 'ConvertController@convert');

Route::get('/download/{file_name}', 'ConvertController@download');