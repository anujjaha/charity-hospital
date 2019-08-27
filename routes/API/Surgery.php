<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('surgery', 'APISurgeryController@index')->name('surgery.index');
    Route::post('surgery/create', 'APISurgeryController@create')->name('surgery.create');
    Route::post('surgery/edit', 'APISurgeryController@edit')->name('surgery.edit');
    Route::post('surgery/show', 'APISurgeryController@show')->name('surgery.show');
    Route::post('surgery/delete', 'APISurgeryController@delete')->name('surgery.delete');
});
?>