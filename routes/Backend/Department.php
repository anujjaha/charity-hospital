<?php

Route::group([
    "namespace"  => "Department",
], function () {
    /*
     * Admin Department Controller
     */

    // Route for Ajax DataTable
    Route::get("department/get", "AdminDepartmentController@getTableData")->name("department.get-list-data");

    Route::resource("department", "AdminDepartmentController");
});