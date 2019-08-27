<?php namespace App\Models\Doctor\Traits\Relationship;

use App\Models\Department\Department;

trait Relationship
{
	/**
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function department()
	{
	    return $this->belongsTo(Department::class, 'department_id');
	}
}