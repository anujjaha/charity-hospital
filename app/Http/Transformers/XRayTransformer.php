<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class XRayTransformer extends Transformer
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
            "xrayId" => (int) $item->id, "xrayTitle" =>  $item->title, "xrayCost" =>  $item->cost, "xrayDescription" =>  $item->description, "xrayCreatedAt" =>  $item->created_at, "xrayUpdatedAt" =>  $item->updated_at, 
        ];
    }
}