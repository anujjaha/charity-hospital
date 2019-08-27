<?php namespace App\Models\BulkUpload;

/**
 * Class BulkUpload
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\BulkUpload\Traits\Attribute\Attribute;
use App\Models\BulkUpload\Traits\Relationship\Relationship;

class BulkUpload extends BaseModel
{
    /**
     * Database Table
     *
     */
    protected $table = "data_bulk_uploads";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}