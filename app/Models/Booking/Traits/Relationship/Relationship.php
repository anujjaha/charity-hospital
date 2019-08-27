<?php namespace App\Models\Booking\Traits\Relationship;

use App\Models\Patient\Patient;
use App\Models\Doctor\Doctor;
use App\Models\PatientSurgery\PatientSurgery;
use App\Models\Department\Department;

trait Relationship
{
	/**
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function doctor()
	{
	    return $this->belongsTo(Doctor::class, 'doctor_id');
	}
	
	/**	
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function department()
	{
	    return $this->belongsTo(Department::class, 'department_id');
	}

	/**
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function patient()
	{
	    return $this->belongsTo(Patient::class, 'patient_id');
	}

	/**
	 * Relationship Mapping for Account
	 * @return mixed
	 */
	public function surgeries()
	{
	    return $this->hasMany(PatientSurgery::class, 'booking_id');
	}
}