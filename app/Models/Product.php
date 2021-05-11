<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const IMAGES_PATH = 'storage/products/';
    use HasFactory;
    protected $guarded=[];

    public function categories()
    {
       return $this->belongsToMany(Category::class,'product_categories')->withTimestamps();
    }
    public function actions(){
       return $this->belongsToMany(Action::class,'action_products')->withTimestamps();
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'ordered_products')->withTimestamps();
    }
}
