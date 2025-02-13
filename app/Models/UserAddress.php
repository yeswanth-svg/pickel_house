<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company',
        'address',
        'apartment',
        'city',
        'state',
        'zip_code',
        'phone',

    ];
}
