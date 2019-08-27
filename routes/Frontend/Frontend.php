<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/jewel-categories', 'FrontendController@jewelCategories')->name('jewel-categories');
Route::get('/jewel-products', 'FrontendController@jewelProducts')->name('jewel-products');
Route::get('/jewel-products-by-category/{id}', 'FrontendController@jewelProductsByCategory')->name('jewel-products-by-category');
Route::get('/product-details/{id}', 'FrontendController@productDetails')->name('jewel-products-details');
Route::get('macros', 'FrontendController@macros')->name('macros');

Route::any('time-piece', 'FrontendController@timePiece')->name('time-piece');

Route::any('accessories', 'FrontendController@accessories')->name('accessories');

Route::any('gifts', 'FrontendController@gifts')->name('gifts');

Route::any('client-service', 'FrontendController@clientService')->name('client-service');

Route::any('corporate', 'FrontendController@corporate')->name('corporate');

Route::any('catelogs', 'FrontendController@catelogs')->name('catelogs');

Route::any('legal-terms', 'FrontendController@legalTerms')->name('legal-terms');

Route::any('help', 'FrontendController@helpDesk')->name('help-desk');

Route::any('contact-us', 'FrontendController@contactUs')->name('contact-us');

/*Route::any('gifts', 'DashboardController@createOrder')->name('create-order');

Route::any('client-service', 'DashboardController@createOrder')->name('create-order');

Route::any('corporate', 'DashboardController@createOrder')->name('create-order');

Route::any('catelogs', 'DashboardController@createOrder')->name('create-order');

Route::any('legal-terms', 'DashboardController@createOrder')->name('create-order');

Route::any('help', 'DashboardController@createOrder')->name('create-order');

Route::any('contact-us', 'DashboardController@createOrder')->name('create-order');*/

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('cart', 'DashboardController@showCart')->name('show-cart');


        Route::post('add-product-to-cart', 'DashboardController@addProductToCart')->name('add-product-to-cart');
            
        Route::post('remove-product-from-cart', 'DashboardController@removeProductToCart')->name('remove-product-from-cart');

        Route::any('create-order', 'DashboardController@createOrder')->name('create-order');

        

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
        
        Route::post('create/patient', 'DashboardController@createNewPatient')->name('patient.create');

        Route::post('create/booking', 'DashboardController@createNewBooking')->name('booking.create');

        Route::post('get-patient-details', 'DashboardController@getPatientDetails')->name('patient.get-patient-details');


        Route::get('doctor-list', 'DashboardController@listDoctor')->name('doctors.list');
        Route::get('create-doctor', 'DashboardController@createDoctor')->name('doctors.create');
        Route::post('create-doctor/store', 'DashboardController@storeDoctor')->name('doctors.store');
        Route::get('doctor/{id}/edit', 'DashboardController@editDoctor')->name('doctors.edit');
        Route::post('update-doctor', 'DashboardController@updateDoctor')->name('doctors.update');
        Route::get('doctor/{id}/destroy', 'DashboardController@deleteDoctor')->name('doctors.destroy');
        
        Route::get('surgery-list', 'DashboardController@listSurgery')->name('surgery.list');
        Route::get('surgery/create', 'DashboardController@createSurgery')->name('surgery.create');
        Route::post('surgery/store', 'DashboardController@storeSurgery')->name('surgery.store');
        Route::get('surgery/{id}/edit', 'DashboardController@editSurgery')->name('surgery.edit');
        Route::post('surgery/update', 'DashboardController@updateSurgery')->name('surgery.update');
        Route::get('surgery/{id}/delete', 'DashboardController@deleteSurgery')->name('surgery.destroy');


        Route::get('patient-list', 'DashboardController@listPatient')->name('patients.list');
        Route::get('patient/{id}/edit', 'DashboardController@editPatient')->name('patients.edit');
        Route::get('create-patient', 'DashboardController@createPatient')->name('patients.create');
        Route::get('patient/{id}/destroy', 'DashboardController@deletePatient')->name('patients.destroy');
        Route::post('create-patient/store', 'DashboardController@storePatient')->name('patients.store');
        Route::post('update-patient', 'DashboardController@updatePatient')->name('patients.update');

        Route::any('history', 'DashboardController@history')->name('history.list');
        Route::any('receipt/{id}/print', 'DashboardController@print')->name('receipt.print');
        
    });
});
