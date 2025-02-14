<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'country',
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
