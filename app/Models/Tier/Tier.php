<?php namespace App\Models\Tier;

/**
 * Class Tier
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Tier\Traits\Attribute\Attribute;
use App\Models\Tier\Traits\Relationship\Relationship;

class Tier extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_tiers";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}