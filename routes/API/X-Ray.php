<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('x-ray', 'APIX-RayController@index')->name('x-ray.index');
    Route::post('x-ray/create', 'APIX-RayController@create')->name('x-ray.create');
    Route::post('x-ray/edit', 'APIX-RayController@edit')->name('x-ray.edit');
    Route::post('x-ray/show', 'APIX-RayController@show')->name('x-ray.show');
    Route::post('x-ray/delete', 'APIX-RayController@delete')->name('x-ray.delete');
});
?>