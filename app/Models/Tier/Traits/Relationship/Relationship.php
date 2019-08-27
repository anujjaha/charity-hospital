<?php namespace App\Models\Tier\Traits\Relationship;


use App\Models\Access\User\User;

trait Relationship
{
	/**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class, 'user_level');
    }

}