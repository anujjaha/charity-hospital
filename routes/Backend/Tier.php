<?php

Route::group([
    'namespace'  => 'Tier',
], function () {

	Route::get('tiers/get', 'AdminTierController@getTableData')->name('tiers.get-list-data');
    
    /*
     * Admin Tier Controller
     */
    Route::resource('tiers', 'AdminTierController');

    Route::get('/', 'AdminTierController@index')->name('tiers.index');
    
});
