<?php

namespace App\Models\Access\User;


use App\Models\BaseModel;
use App\Models\Access\User\User;

/**
 * Class User.
 */
class UserToken extends BaseModel
{
    /**
     * Database Table
     *
     */
    protected $table = "data_device_tokens";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'token'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
