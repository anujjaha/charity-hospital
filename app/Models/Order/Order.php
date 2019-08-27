<?php namespace App\Models\Order;

/**
 * Class Order
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Order\Traits\Attribute\Attribute;
use App\Models\Order\Traits\Relationship\Relationship;

class Order extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_orders";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'title',
        'subtotal',
        'tax',
        'discount',
        'total_amount',
        'due',
        'total_qty',
        'total_cost',
        'description'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}