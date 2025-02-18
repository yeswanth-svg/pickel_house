<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishlistItem extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'dish_id',
        'user_id',
        'quantity_id',
        'total_amount',
        'cart_quantity',
        'spice_level'
    ];


    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quantity()
    {
        return $this->belongsTo(DishQuantity::class, 'quantity_id'); // 'dish_type_id' is the foreign key in dishes table
    }
}
