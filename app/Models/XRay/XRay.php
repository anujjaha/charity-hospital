<?php namespace App\Models\XRay;

/**
 * Class XRay
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\XRay\Traits\Attribute\Attribute;
use App\Models\XRay\Traits\Relationship\Relationship;

class XRay extends BaseModel
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