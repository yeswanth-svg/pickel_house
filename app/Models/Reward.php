<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    //

    protected $fillable = [
        'min_cart_value',
        'reward_name',
        'reward_message',
    ];
}
