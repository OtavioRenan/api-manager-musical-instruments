<?php

use Illuminate\Support\Facades\Route;
// Função routeUnion() em App\Main\Helpers

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router)
{
    Route::post('/register', routeUnion('\Autentication' ,'store'));
    Route::post('/login', routeUnion('\Autentication' ,'auth'));
    Route::post('/logout', routeUnion('\Autentication' ,'logout'));
    Route::post('/refresh', routeUnion('\Autentication' ,'refresh'));
    Route::get('/user-profile', routeUnion('\Autentication' ,'userProfile'));
});

Route::group(['middleware' => 'autentication'], function ()
{
    Route::resource('instrument', routeUnion('\Instrument'));
    Route::resource('instruments-type', routeUnion('\InstrumentType'));
    Route::resource('mark', routeUnion('\Mark'));
    Route::resource('model', routeUnion('\Model'));
    Route::resource('model-year', routeUnion('\ModelYear'));
    Route::resource('user', routeUnion('\User'))->only(['show', 'index']);
});