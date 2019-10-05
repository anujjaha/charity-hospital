<?php

Route::group([
    "namespace"  => "X-Ray",
], function () {
    /*
     * Admin X-Ray Controller
     */

    // Route for Ajax DataTable
    Route::get("x-ray/get", "AdminX-RayController@getTableData")->name("x-ray.get-list-data");

    Route::resource("x-ray", "AdminX-RayController");
});