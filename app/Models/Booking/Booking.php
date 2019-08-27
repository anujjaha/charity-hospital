<?php namespace App\Models\Booking;

/**
 * Class Booking
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Booking\Traits\Attribute\Attribute;
use App\Models\Booking\Traits\Relationship\Relationship;

class Booking extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_bookings";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "department_id", "doctor_id", "patient_id", "queue_number", "consulting_fees", "total", "notes", "booking_date", "status", "created_at", "updated_at", 
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