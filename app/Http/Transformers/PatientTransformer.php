<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class PatientTransformer extends Transformer
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
            "patientId" => (int) $item->id, "patientName" =>  $item->name, "patientValidity" =>  $item->validity, "patientMobile" =>  $item->mobile, "patientOtherContact" =>  $item->other_contact, "patientEmailid" =>  $item->emailid, "patientAddress" =>  $item->address, "patientCity" =>  $item->city, "patientState" =>  $item->state, "patientZip" =>  $item->zip, "patientNotes" =>  $item->notes, "patientStatus" =>  $item->status, "patientCreatedAt" =>  $item->created_at, "patientUpdatedAt" =>  $item->updated_at, 
        ];
    }
}