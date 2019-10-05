<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('xray', 'APIXRayController@index')->name('xray.index');
    Route::post('xray/create', 'APIXRayController@create')->name('xray.create');
    Route::post('xray/edit', 'APIXRayController@edit')->name('xray.edit');
    Route::post('xray/show', 'APIXRayController@show')->name('xray.show');
    Route::post('xray/delete', 'APIXRayController@delete')->name('xray.delete');
});
?>