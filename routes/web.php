<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController')->name('home');

Route::prefix('sites')->name('sites.')->namespace('Api')->group(function () {
    Route::get('surah', 'SiteApiController@index')->name('index');
    Route::get('{id}/surah', 'SiteApiController@detail')->name('detail');
});
