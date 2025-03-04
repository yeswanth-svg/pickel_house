<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    //
    use HasFactory;

    protected $fillable = ['dish_id', 'user_id', 'title', 'content', 'rating'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
