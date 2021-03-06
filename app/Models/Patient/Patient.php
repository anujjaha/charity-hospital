<?php namespace App\Models\Patient;

/**
 * Class Patient
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Patient\Traits\Attribute\Attribute;
use App\Models\Patient\Traits\Relationship\Relationship;

class Patient extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_patients";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "patient_number", "name", "validity", "age", "mobile", "other_contact", "emailid", "address", "city", "state", "zip", "notes", "status", "created_at", "updated_at", 
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