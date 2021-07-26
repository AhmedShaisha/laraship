<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'qualityTests', 'as' => 'qualityTests.' ], function () {
    
    
    Route::put('{qualityTest}/shipping_update','QualityTestsController@updateShipping')->name('updateShipping');
    Route::get('download/{id}', 'QualityTestsController@downloadFile');
    Route::put('{order_item}/update_qualityTest_status','QualityTestsController@updateQualityStatus')->name('updateQualityStatus');
    Route::put('{order_item}/update_BuyerFormAgreement','QualityTestsController@updateBuyerFormAgreement')->name('updateBuyerFormAgreement');
    Route::get('settings', 'QualitySettingsController@settings')->name('settings');
    Route::post('settings', 'QualitySettingsController@saveSettings')->name('saveSettings');
    

});
Route::resource('qualityTests', 'QualityTestsController');

//added
Route::group(['prefix' => 'marketplace', 'as' => 'marketplace.'], function () {
   
    Route::get('products/{product}/show_qualityTest_status','QualityTestsController@showQualityStatus')->name('showQualityStatus');
    Route::get('orders/{order_item}/BuyerFormAgreement','QualityTestsController@showBuyerFormAgreement')->name('showBuyerFormAgreement');
    //Route::put('orders/{order_item}/update_qualityTest_status','QualityTestsController@updateQualityStatus')->name('updateQualityStatus');
    //Route::put('orders/{order_item}/update_BuyerFormAgreement','QualityTestsController@updateBuyerFormAgreement')->name('updateBuyerFormAgreement');
   
    });

  
