<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class PatientXRayTransformer extends Transformer
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
            "patientxrayId" => (int) $item->id, "patientxrayDepartmentId" =>  $item->department_id, "patientxrayXrayId" =>  $item->xray_id, "patientxrayPatientId" =>  $item->patient_id, "patientxrayDoctorId" =>  $item->doctor_id, "patientxrayXrayTitle" =>  $item->xray_title, "patientxrayXrayCost" =>  $item->xray_cost, "patientxrayXrayDescription" =>  $item->xray_description, "patientxrayCreatedAt" =>  $item->created_at, "patientxrayUpdatedAt" =>  $item->updated_at, 
        ];
    }
}