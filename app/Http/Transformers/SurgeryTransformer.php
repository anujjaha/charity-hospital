<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class SurgeryTransformer extends Transformer
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
            "surgeryId" => (int) $item->id, "surgeryTitle" =>  $item->title, "surgeryFees" =>  $item->fees, "surgeryNotes" =>  $item->notes, "surgeryStatus" =>  $item->status, "surgeryCreatedAt" =>  $item->created_at, "surgeryUpdatedAt" =>  $item->updated_at, 
        ];
    }
}