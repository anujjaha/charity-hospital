<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class DoctorTransformer extends Transformer
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
            "doctorId" => (int) $item->id, "doctorDepartmentId" =>  $item->department_id, "doctorName" =>  $item->name, "doctorDesignation" =>  $item->designation, "doctorMobile" =>  $item->mobile, "doctorOtherContact" =>  $item->other_contact, "doctorEmailid" =>  $item->emailid, "doctorAddress" =>  $item->address, "doctorCity" =>  $item->city, "doctorState" =>  $item->state, "doctorZip" =>  $item->zip, "doctorNotes" =>  $item->notes, "doctorStatus" =>  $item->status, "doctorCreatedAt" =>  $item->created_at, "doctorUpdatedAt" =>  $item->updated_at, 
        ];
    }
}