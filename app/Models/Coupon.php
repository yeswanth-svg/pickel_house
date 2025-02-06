<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //

    protected $fillable = [
        "code",
        "type",
        "value",
        "minimum_order_value",
        "expiry_date",
        "active",
    ];
}
