<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => ''], function () {
    Route::resource('approveRequests', 'ApproveRequestsController');
    Route::get('approveRequests/{product}/showRequest','ApproveRequestsController@showRequest')->name('products.showRequest');
});