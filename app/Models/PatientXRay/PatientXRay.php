<?php namespace App\Models\PatientXRay;

/**
 * Class PatientXRay
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\PatientXRay\Traits\Attribute\Attribute;
use App\Models\PatientXRay\Traits\Relationship\Relationship;

class PatientXRay extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_patient_xrays";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "department_id", "xray_id", "patient_id", "doctor_id", "doctor_name", "xray_title", "xray_cost", "xray_description", "created_at", "updated_at", 
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