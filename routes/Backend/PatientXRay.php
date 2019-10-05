<?php

Route::group([
    "namespace"  => "PatientXRay",
], function () {
    /*
     * Admin PatientXRay Controller
     */

    // Route for Ajax DataTable
    Route::get("patientxray/get", "AdminPatientXRayController@getTableData")->name("patientxray.get-list-data");

    Route::resource("patientxray", "AdminPatientXRayController");
});