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

// root


Route::get('/', function () {
    return view('index');
});

Route::get('/ipa', function(){
    return view('ipa');
});

Route::get('/ips', function(){
    return view('ips');
});

Route::get('/pengujian',function(){
    return view('pengujian');
});

Route::post('/result','SiswaController@index');

// Route::get('/result','ProgramStudiController@getNamaProgramStudi');

// result
Route::get('/result', function () {
    return view('result');
});

Route::get('/login', function () {
    return view('login');
});

// Route::get('/result', 'ProgramStudiController@index');

Route::get('/test','TestController@index');
?>