<?php

use Illuminate\Support\Facades\Route;
// Função routeUnion() em App\Main\Helpers

Route::post('login', routeUnion('\Autentication' ,'store'));

Route::group(['middleware' => 'autentication'], function () {
    Route::resource('instruments', routeUnion('\Instrument'));
    Route::resource('instruments-types', routeUnion('\InstrumentType'));
    Route::resource('users', routeUnion('\User'))->only(['show', 'index']);
});

