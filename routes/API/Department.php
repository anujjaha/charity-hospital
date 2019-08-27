<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('department', 'APIDepartmentController@index')->name('department.index');
    Route::post('department/create', 'APIDepartmentController@create')->name('department.create');
    Route::post('department/edit', 'APIDepartmentController@edit')->name('department.edit');
    Route::post('department/show', 'APIDepartmentController@show')->name('department.show');
    Route::post('department/delete', 'APIDepartmentController@delete')->name('department.delete');
});
?>