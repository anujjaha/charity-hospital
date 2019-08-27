<?php namespace App\Models\OrderItem\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\Order\Order;
use App\Models\Product\Product;

trait Relationship
{
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function order()
	{
	    return $this->belongsTo(Order::class);
	}

	public function product()
	{
	    return $this->belongsTo(Product::class);
	}
}