<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('doctor', 'APIDoctorController@index')->name('doctor.index');
    Route::post('doctor/create', 'APIDoctorController@create')->name('doctor.create');
    Route::post('doctor/edit', 'APIDoctorController@edit')->name('doctor.edit');
    Route::post('doctor/show', 'APIDoctorController@show')->name('doctor.show');
    Route::post('doctor/delete', 'APIDoctorController@delete')->name('doctor.delete');
});
?>