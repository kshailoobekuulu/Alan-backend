<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function categories()
    {
       return $this->belongsToMany(Category::class)->withTimestamps;
    }
    public function actions(){
       return $this->belongsToMany(Action::class,'action_products','action_id','product_id');
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withTimestamps;
//       return $this->belongsToMany(Order::class)->withTimestamps;
    }
}
