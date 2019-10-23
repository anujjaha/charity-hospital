<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('backup', 'APIBackupController@index')->name('backup.index');
    Route::post('backup/create', 'APIBackupController@create')->name('backup.create');
    Route::post('backup/edit', 'APIBackupController@edit')->name('backup.edit');
    Route::post('backup/show', 'APIBackupController@show')->name('backup.show');
    Route::post('backup/delete', 'APIBackupController@delete')->name('backup.delete');
});
?>