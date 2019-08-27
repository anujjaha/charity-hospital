<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class DepartmentTransformer extends Transformer
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
            "departmentId" => (int) $item->id, "departmentName" =>  $item->name, "departmentNotes" =>  $item->notes, "departmentStatus" =>  $item->status, "departmentCreatedAt" =>  $item->created_at, "departmentUpdatedAt" =>  $item->updated_at, 
        ];
    }
}