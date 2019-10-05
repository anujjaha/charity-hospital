<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class X-RayTransformer extends Transformer
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
            "x-rayId" => (int) $item->id, "x-rayTitle" =>  $item->title, "x-rayCost" =>  $item->cost, "x-rayDescription" =>  $item->description, "x-rayCreatedAt" =>  $item->created_at, "x-rayUpdatedAt" =>  $item->updated_at, 
        ];
    }
}