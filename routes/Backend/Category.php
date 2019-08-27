<?php

Route::group([
    'namespace'  => 'Category',
], function () {

	Route::get('category/get', 'AdminCategoryController@getTableData')->name('category.get-list-data');
    
    /*
     * Admin Category Controller
     */
    Route::resource('category', 'AdminCategoryController');

    Route::get('category/', 'AdminCategoryController@index')->name('category.index');
    
});
