<?php namespace App\Models\X-Ray;

/**
 * Class X-Ray
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\X-Ray\Traits\Attribute\Attribute;
use App\Models\X-Ray\Traits\Relationship\Relationship;

class X-Ray extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_xrays";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "title", "cost", "description", "created_at", "updated_at", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}