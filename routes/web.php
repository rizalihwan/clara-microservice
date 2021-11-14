<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController')->name('home');

Route::prefix('sites')->name('sites.')->namespace('Api')->group(function () {
    Route::get('index', 'SiteApiController@index')->name('index');
    // Route::get('detail/{id}', 'SiteApiController@detail')->name('detail');
    // Route::post('add', 'SiteApiController@store')->name('store');
    // Route::delete('destroy/{id}', 'SiteApiController@destroy')->name('destroy');

    // Route::get('api/corona', 'SiteApiController@coronaApi')->name('corona');

    // quran API
    // Route::prefix('quran')->group(function() {
    //     Route::get('imam', 'SiteApiController@getImam');
    //     Route::get('quran', 'SiteApiController@quranApi');
    // });
});
