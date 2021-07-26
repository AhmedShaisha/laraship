<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => ''], function () {
    Route::get('customerSupports/{customerSupport}/showResponse','customerSupportsController@showResponse')->name('customerSupports.showResponse');
    Route::resource('customerSupports', 'CustomerSupportsController');
    Route::post('customerSupports/{customerSupport}/comment', 'CustomerSupportsController@comment');
   // Route::post('customerSupports/{order}/createO', 'CustomerSupportsController@createO');
    Route::get('/suport/ticket/files/{id}', 'CustomerSupportsController@downloadFile');
    Route::get('/support/ask','CustomerSupportPublicController@create');
    Route::resource('questions','CustomerSupportPublicController');
    //Route::post('customerSupports/{customerSupport}/comment', 'CustomerSupportsController@comment');
  //  support/new
});