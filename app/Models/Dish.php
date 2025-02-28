<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    //

    //
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'category_id',
        'price',
        'quantity',
        'availability_status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // 'dish_type_id' is the foreign key in dishes table
    }

    public function quantities()
    {
        return $this->hasMany(DishQuantity::class);
    }

    public function images()
    {
        return $this->hasMany(DishImage::class);
    }
}
