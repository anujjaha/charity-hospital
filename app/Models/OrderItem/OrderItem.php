<?php namespace App\Models\OrderItem;

/**
 * Class OrderItem
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\OrderItem\Traits\Attribute\Attribute;
use App\Models\OrderItem\Traits\Relationship\Relationship;

class OrderItem extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_order_items";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'qty',
        'price',
        'total',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}