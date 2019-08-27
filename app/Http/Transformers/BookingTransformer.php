<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class BookingTransformer extends Transformer
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
            "bookingId" => (int) $item->id, "bookingDoctorId" =>  $item->doctor_id, "bookingPatientId" =>  $item->patient_id, "bookingQueueNumber" =>  $item->queue_number, "bookingConsultingFees" =>  $item->consulting_fees, "bookingNotes" =>  $item->notes, "bookingStatus" =>  $item->status, "bookingCreatedAt" =>  $item->created_at, "bookingUpdatedAt" =>  $item->updated_at, 
        ];
    }
}