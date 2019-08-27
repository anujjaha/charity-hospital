<?php namespace App\Models\PatientSurgery\Traits\Relationship;

use App\Models\Surgery\Surgery;

trait Relationship
{
	/**
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function surgery()
	{
	    return $this->belongsTo(Surgery::class, 'surgery_id');
	}
}