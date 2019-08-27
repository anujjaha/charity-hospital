<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('patientsurgery', 'APIPatientSurgeryController@index')->name('patientsurgery.index');
    Route::post('patientsurgery/create', 'APIPatientSurgeryController@create')->name('patientsurgery.create');
    Route::post('patientsurgery/edit', 'APIPatientSurgeryController@edit')->name('patientsurgery.edit');
    Route::post('patientsurgery/show', 'APIPatientSurgeryController@show')->name('patientsurgery.show');
    Route::post('patientsurgery/delete', 'APIPatientSurgeryController@delete')->name('patientsurgery.delete');
});
?>