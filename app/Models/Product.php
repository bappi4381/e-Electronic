<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'price', 
        'brand',
        'category_id',
        'subcategory_id', 
        'quantity', 
        'image', 
        'description'
    ];

    // Define the relationship to the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hotdeals()
    {
        return $this->hasMany(Hotdeals::class);
    }
}
