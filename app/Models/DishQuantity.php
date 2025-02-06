<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishQuantity extends Model
{
    //
    protected $fillable = [
        'dish_id',
        'quantity',
        'price',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
