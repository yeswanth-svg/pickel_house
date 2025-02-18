<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    //
    protected $fillable = [

        'country',
        'min_weight',
        'max_weight',
        'standard_rate',
        'priority_rate',
        'currency'
    ];
}
