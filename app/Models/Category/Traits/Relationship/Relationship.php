<?php namespace App\Models\Category\Traits\Relationship;

use App\Models\Product\Product;

trait Relationship
{
	public function products()
	{
		return $this->hasMany(Product::class);
	}
}