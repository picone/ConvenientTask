<?php

use App\Http\Middleware\HasLogin;
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
})->name('index');

Route::group(['prefix'=>'/common'],function(){
    Route::get('/captcha','CommonController@captcha');
});

Route::group(['prefix'=>'/user','as'=>'user:'],function(){
    Route::post('/login','UserController@login');
    Route::post('/logout','UserController@logout')->middleware(HasLogin::class);
    Route::get('/profile','UserController@profile')->middleware(HasLogin::class);
    Route::post('/deposit','UserController@deposit')->middleware(HasLogin::class);
    Route::any('/passpay','UserController@passpay')->name('passpay');
});

Route::group(['prefix'=>'/record','as'=>'record:','middleware'=>HasLogin::class],function(){
    Route::get('/consume','RecordController@consume');
});

//Route::any('/uc/{note}','\VergilLai\UcClient\Controller@api');
