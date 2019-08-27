<?php namespace App\Models\PatientSurgery;

/**
 * Class PatientSurgery
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\PatientSurgery\Traits\Attribute\Attribute;
use App\Models\PatientSurgery\Traits\Relationship\Relationship;

class PatientSurgery extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "patient_surgeries";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "patient_id", "doctor_id", "booking_id", "surgery_id", "notes", "status", "created_at", "updated_at", 
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