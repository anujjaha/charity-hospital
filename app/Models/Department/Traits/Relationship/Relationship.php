<?php namespace App\Models\Department\Traits\Relationship;

use App\Models\Booking\Booking;

trait Relationship
{
	/**	
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function bookings()
	{
	    return $this->hasMany(Booking::class, 'department_id');
	}
}