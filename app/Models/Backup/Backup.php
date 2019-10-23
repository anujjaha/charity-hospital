<?php namespace App\Models\Backup;

/**
 * Class Backup
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Backup\Traits\Attribute\Attribute;
use App\Models\Backup\Traits\Relationship\Relationship;

class Backup extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_backups";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "user_id", "file_title", "description", "created_at", "updated_at", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}