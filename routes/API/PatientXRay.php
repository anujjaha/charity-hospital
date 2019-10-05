<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('patientxray', 'APIPatientXRayController@index')->name('patientxray.index');
    Route::post('patientxray/create', 'APIPatientXRayController@create')->name('patientxray.create');
    Route::post('patientxray/edit', 'APIPatientXRayController@edit')->name('patientxray.edit');
    Route::post('patientxray/show', 'APIPatientXRayController@show')->name('patientxray.show');
    Route::post('patientxray/delete', 'APIPatientXRayController@delete')->name('patientxray.delete');
});
?>