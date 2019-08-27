<?php namespace App\Models\Department;

/**
 * Class Department
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Department\Traits\Attribute\Attribute;
use App\Models\Department\Traits\Relationship\Relationship;

class Department extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_departments";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "name", "notes", "status", "created_at", "updated_at", 
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