<?php

use Illuminate\Support\Facades\Route;
// Função routeUnion() em App\Main\Helpers

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router)
{
    Route::post('/login', routeUnion('\Autentication' ,'auth'));
    Route::post('/register', routeUnion('\Autentication' ,'store'));
    Route::post('/logout', routeUnion('\Autentication' ,'logout'));
    Route::post('/refresh', routeUnion('\Autentication' ,'refresh'));
    Route::get('/user-profile', routeUnion('\Autentication' ,'userProfile'));
});

Route::group(['middleware' => 'autentication'], function ()
{
    Route::resource('instruments', routeUnion('\Instrument'));
    Route::resource('instruments-types', routeUnion('\InstrumentType'));
    Route::resource('users', routeUnion('\User'))->only(['show', 'index']);
});