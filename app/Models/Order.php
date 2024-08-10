<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'address',
        'total_price',
        'total_quantity',
        'status',
        'date',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Product model
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
