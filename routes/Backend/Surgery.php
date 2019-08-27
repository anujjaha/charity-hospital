<?php

Route::group([
    "namespace"  => "Surgery",
], function () {
    /*
     * Admin Surgery Controller
     */

    // Route for Ajax DataTable
    Route::get("surgery/get", "AdminSurgeryController@getTableData")->name("surgery.get-list-data");

    Route::resource("surgery", "AdminSurgeryController");
});