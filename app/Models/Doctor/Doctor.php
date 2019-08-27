<?php namespace App\Models\Doctor;

/**
 * Class Doctor
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Doctor\Traits\Attribute\Attribute;
use App\Models\Doctor\Traits\Relationship\Relationship;

class Doctor extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_doctors";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "department_id", "name", "designation", "mobile", "fees", "other_contact", "emailid", "address", "city", "state", "zip", "notes", "status", "created_at", "updated_at", 
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