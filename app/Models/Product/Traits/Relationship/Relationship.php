<?php namespace App\Models\Product\Traits\Relationship;

use App\Models\Category\Category;

trait Relationship
{
	public function category()
	{
	    return $this->belongsTo(Category::class);
	}
}