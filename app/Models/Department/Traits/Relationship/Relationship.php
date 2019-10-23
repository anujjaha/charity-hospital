<?php namespace App\Models\Department\Traits\Relationship;

use App\Models\Booking\Booking;
use App\Models\PatientXRay\PatientXRay;

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

	/**	
	 * Relationship Mapping for XRay
	 * @return mixed
	 */
	public function xrays()
	{
	    return $this->hasMany(PatientXRay::class, 'department_id');
	}
}