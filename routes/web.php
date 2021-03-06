<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

access()->takeBackup();

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap')->name('set-lang');


/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
    
    Route::get('custom-settings/policy', 'FrontendController@customPolicy');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

	//Route::get('products/', 'AdminProductController@index')->name('product.get-products');
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');

});
