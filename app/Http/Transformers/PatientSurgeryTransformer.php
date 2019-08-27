<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class PatientSurgeryTransformer extends Transformer
{
    /**
     * Transform
     *
     * @param array $data
     * @return array
     */
    public function transform($item)
    {
        if(is_array($item))
        {
            $item = (object)$item;
        }

        return [
            "patientsurgeryId" => (int) $item->id, "patientsurgeryPatientId" =>  $item->patient_id, "patientsurgeryDoctorId" =>  $item->doctor_id, "patientsurgeryBookingId" =>  $item->booking_id, "patientsurgerySurgeryId" =>  $item->surgery_id, "patientsurgeryNotes" =>  $item->notes, "patientsurgeryStatus" =>  $item->status, "patientsurgeryCreatedAt" =>  $item->created_at, "patientsurgeryUpdatedAt" =>  $item->updated_at, 
        ];
    }
}