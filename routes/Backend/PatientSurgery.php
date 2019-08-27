<?php

Route::group([
    "namespace"  => "PatientSurgery",
], function () {
    /*
     * Admin PatientSurgery Controller
     */

    // Route for Ajax DataTable
    Route::get("patientsurgery/get", "AdminPatientSurgeryController@getTableData")->name("patientsurgery.get-list-data");

    Route::resource("patientsurgery", "AdminPatientSurgeryController");
});