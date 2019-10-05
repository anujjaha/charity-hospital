<?php

Route::group([
    "namespace"  => "XRay",
], function () {
    /*
     * Admin XRay Controller
     */

    // Route for Ajax DataTable
    Route::get("xray/get", "AdminXRayController@getTableData")->name("xray.get-list-data");

    Route::resource("xray", "AdminXRayController");
});