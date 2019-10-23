<?php

Route::group([
    "namespace"  => "Backup",
], function () {
    /*
     * Admin Backup Controller
     */

    // Route for Ajax DataTable
    Route::get("backup/get", "AdminBackupController@getTableData")->name("backup.get-list-data");

    Route::resource("backup", "AdminBackupController");
});