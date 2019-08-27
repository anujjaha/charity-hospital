<?php namespace App\Models\TierLevel;

/**
 * Class TierLevel
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;

class TierLevel extends BaseModel
{
    /**
     * Database Table
     *
     */
    protected $table = "data_tier_levels";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'category_id',
        'user_level'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}