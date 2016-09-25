<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index',['user'=>Auth::user()]);
});

Route::group(['prefix'=>'/common'],function(){
    Route::get('/captcha','CommonController@captcha');
});

Route::group(['prefix'=>'/user'],function(){
    Route::post('/login','UserController@login');
});

//Route::any('/uc/{note}','\VergilLai\UcClient\Controller@api');
