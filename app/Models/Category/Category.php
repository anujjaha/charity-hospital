<?php namespace App\Models\Category;

/**
 * Class Category
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Category\Traits\Attribute\Attribute;
use App\Models\Category\Traits\Relationship\Relationship;

class Category extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_categories";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}