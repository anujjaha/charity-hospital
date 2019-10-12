<?php namespace App\Models\PatientXRay\Traits\Relationship;


use App\Models\Patient\Patient;
use App\Models\Department\Department;
use App\Models\PatientXRay\PatientXRay;

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
	public function chlidren()
	{
	    return $this->hasMany(PatientXRay::class, 'parent_id');
	}
}