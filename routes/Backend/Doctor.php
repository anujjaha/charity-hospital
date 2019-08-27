<?php

Route::group([
    "namespace"  => "Doctor",
], function () {
    /*
     * Admin Doctor Controller
     */

    // Route for Ajax DataTable
    Route::get("doctor/get", "AdminDoctorController@getTableData")->name("doctor.get-list-data");

    Route::resource("doctor", "AdminDoctorController");
});