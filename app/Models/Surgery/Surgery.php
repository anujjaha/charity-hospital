<?php namespace App\Models\Surgery;

/**
 * Class Surgery
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Surgery\Traits\Attribute\Attribute;
use App\Models\Surgery\Traits\Relationship\Relationship;

class Surgery extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_surgeries";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", 'department_id', "title", "fees", "notes", "status", "created_at", "updated_at", 
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