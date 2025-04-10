<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //

    use HasFactory;
    protected $fillable = [
        'dish_id',
        'user_id',
        'quantity_id',
        'spice_level',
        'order_stage',
        'payment_state',
        'original_price',
        'discount_price',
        'total_amount',
        'applied_coupon_id',
        'coupon_discount',
        'selected_address',
        'razorpay_payment_id',
        'cart_quantity',
        'type_of_shipping',
        'reward_message',
        'cancellation_reason',
        'shipping_cost',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function user_address()
    {
        return $this->belongsTo(UserAddress::class, 'user_id');
    }

    public function quantity()
    {
        return $this->belongsTo(DishQuantity::class, 'quantity_id'); // 'dish_type_id' is the foreign key in dishes table
    }
}
