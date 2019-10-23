<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class BackupTransformer extends Transformer
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
            "backupId" => (int) $item->id, "backupUserId" =>  $item->user_id, "backupFileTitle" =>  $item->file_title, "backupDescription" =>  $item->description, "backupCreatedAt" =>  $item->created_at, "backupUpdatedAt" =>  $item->updated_at, 
        ];
    }
}