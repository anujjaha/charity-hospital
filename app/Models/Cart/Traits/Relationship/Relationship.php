<?php namespace App\Models\Cart\Traits\Relationship;

use App\Models\Product\Product;
use App\Models\Access\User\User;

trait Relationship
{
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}

