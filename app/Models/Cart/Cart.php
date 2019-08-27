<?php namespace App\Models\Cart;

/**
 * Class Cart
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Cart\Traits\Attribute\Attribute;
use App\Models\Cart\Traits\Relationship\Relationship;

class Cart extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_cart";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'qty'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}